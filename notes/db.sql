DROP TABLE IF EXISTS company;
CREATE TABLE IF NOT EXISTS company
(
    code              varchar(10) PRIMARY KEY,
    name              varchar(255),
    code_industry     int,
    market_cap        bigint,
    volume_10_session bigint,
    max_52_weeks      decimal(13, 2),
    min_52_weeks      decimal(13, 2),
    shares            bigint,
    free_float        decimal(5, 4),
    beta              decimal(8, 2),
    pe                decimal(8, 2),
    pb                decimal(8, 2),
    dividend_rate     decimal(5, 4),
    bvps              decimal(13, 2),
    roae              decimal(5, 4),
    roaa              decimal(5, 4),
    eps               decimal(13, 2),
    INDEX (code_industry)
);

DROP TABLE IF EXISTS company_historical_data;
CREATE TABLE IF NOT EXISTS company_historical_data
(
    id                        bigint auto_increment primary key,
    code                      varchar(10),
    report_type               enum ('QUARTER', 'ANNUAL'),
    fiscal_date               datetime,
    asset_total               bigint,
    short_term_dept           bigint,
    long_term_dept            bigint,
    equity                    bigint,
    net_income                bigint,
    gross_profit              bigint,
    nopat                     bigint,
    operating_cash_flow       bigint,
    cash_and_cash_equivalents bigint,
    constraint company_historical_data_unique unique (code, report_type, fiscal_date),
    constraint company_historical_data_code_fk foreign key (code) references company (code) ON update cascade on delete cascade,
    index (fiscal_date)
);
