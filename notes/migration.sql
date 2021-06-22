# DROP TABLE IF EXISTS company;
# CREATE TABLE IF NOT EXISTS company
# (
#     code              varchar(10) PRIMARY KEY,
#     name              varchar(255),
#     code_industry     int,
#     market_cap        bigint,
#     volume_10_session bigint,
#     max_52_weeks      decimal(13, 2),
#     min_52_weeks      decimal(13, 2),
#     shares            bigint,
#     free_float        decimal(5, 4),
#     beta              decimal(8, 2),
#     pe                decimal(8, 2),
#     pb                decimal(8, 2),
#     dividend_rate     decimal(5, 4),
#     bvps              decimal(13, 2),
#     roae              decimal(5, 4),
#     roaa              decimal(5, 4),
#     eps               decimal(13, 2),
#     INDEX (code_industry)
# );
#
# DROP TABLE IF EXISTS company_historical_data;
# CREATE TABLE IF NOT EXISTS company_historical_data
# (
#     id                        bigint auto_increment primary key,
#     code                      varchar(10),
#     report_type               enum ('QUARTER', 'ANNUAL'),
#     fiscal_date               datetime,
#     asset_total               bigint,
#     short_term_dept           bigint,
#     long_term_dept            bigint,
#     equity                    bigint,
#     net_income                bigint,
#     gross_profit              bigint,
#     nopat                     bigint,
#     operating_cash_flow       bigint,
#     cash_and_cash_equivalents bigint,
#     constraint company_historical_data_unique unique (code, report_type, fiscal_date),
#     constraint company_historical_data_code_fk foreign key (code) references company (code) ON update cascade on delete cascade,
#     index (fiscal_date)
# );

# ALTER TABLE company_historical_data
#     ADD COLUMN equity_yoy              decimal(5, 4) AFTER equity,
#     ADD COLUMN net_income_yoy          decimal(5, 4) AFTER net_income,
#     ADD COLUMN nopat_yoy               decimal(5, 4) AFTER nopat,
#     ADD COLUMN operating_cash_flow_yoy decimal(5, 4) AFTER operating_cash_flow;

# ALTER TABLE company_historical_data
#     MODIFY COLUMN equity_yoy              decimal(8, 4),
#     MODIFY COLUMN net_income_yoy          decimal(8, 4),
#     MODIFY COLUMN nopat_yoy               decimal(8, 4),
#     MODIFY COLUMN operating_cash_flow_yoy decimal(8, 4),
#     ADD COLUMN roic              decimal(8, 4);

# ALTER TABLE company
#     MODIFY COLUMN free_float        decimal(8, 4),
#     MODIFY COLUMN dividend_rate     decimal(8, 4),
#     MODIFY COLUMN roae              decimal(8, 4),
#     MODIFY COLUMN roaa              decimal(8, 4);

# DROP TABLE IF EXISTS company_analysing_4m;
# CREATE TABLE IF NOT EXISTS company_analysing_4m
# (
#     id                            BIGINT AUTO_INCREMENT PRIMARY KEY,
#     code                          VARCHAR(10),
#
#     equity_grow_rate              decimal(8, 4),
#     net_income_grow_rate          decimal(8, 4),
#     nopat_grow_rate               decimal(8, 4),
#     operating_cash_flow_grow_rate decimal(8, 4),
#
#     future_eps_grow_rate decimal(8, 4),
#     future_pe decimal(8, 2),
#     minimum_acceptable_rate decimal(8, 4),
#     margin_of_safe decimal(8, 4),
#
#     future_retail_value decimal(13, 2),
#     sticker_price decimal(13, 2),
#     mos_price decimal(13, 2),
#
#     graham_price decimal(13, 2),
#     graham_mos_price decimal(13, 2),
#
#     chosen_price decimal(13, 2),
#     CONSTRAINT company_analysing_4m_code_fk
#         FOREIGN KEY (code) REFERENCES company (code)
#             ON UPDATE CASCADE ON DELETE CASCADE
# );

# UPDATE company SET code_industry = '8600' where 1;
