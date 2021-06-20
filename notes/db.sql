DROP TABLE IF EXISTS company;
CREATE TABLE IF NOT EXISTS company
(
    code              varchar(10) PRIMARY KEY,
    name  varchar(255),
    code_industry  int,
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
