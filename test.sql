WITH RECURSIVE DateRange AS (
    SELECT
        '2001-01-01'::TIMESTAMP WITHOUT TIME ZONE AS Date
    UNION ALL
    SELECT
            Date + INTERVAL '1 day'
    FROM
        DateRange
    WHERE
            Date < CURRENT_DATE
)
SELECT
    DateRange.Date::DATE,
    COALESCE("testCompanyDB".public."testCompanyDBmodified"."companyName", 'null') AS companyName
FROM
    DateRange
        LEFT JOIN
    "testCompanyDBmodified" ON DateRange.Date::DATE = "testCompanyDBmodified"."companyFoundationDate"::DATE
ORDER BY
    DateRange.Date::DATE;


CREATE OR REPLACE FUNCTION dynamic_pivot_activity()
    RETURNS TABLE("companyName" TEXT, activity_types TEXT[])
AS $$
DECLARE
    columns text;
    query text;
BEGIN
    -- Generate the list of distinct activities
    SELECT STRING_AGG(DISTINCT FORMAT('MAX(CASE WHEN activity = %L THEN "companyName" ELSE NULL END) AS %I', activity, activity), ', ')
    INTO columns
    FROM (SELECT DISTINCT activity FROM "testCompanyDBmodified") as aa;

    query := FORMAT('
        SELECT
            %s
        FROM
            "testCompanyDBmodified"
        GROUP BY
            "companyName"
    ', columns);

    RETURN QUERY EXECUTE query;
END;
$$ LANGUAGE plpgsql;
