-- filtered list : good price
SELECT c.code,
       c.code_industry,
       c.market_cap,
       c.roic,
       ca4m.nopat_grow_rate,
       ca4m.net_income_grow_rate,
       ca4m.equity_grow_rate,
       ca4m.operating_cash_flow_grow_rate,
       c.stock_price,
       ca4m.mos_price,
       ca4m.graham_mos_price
FROM company c
         JOIN company_analysing_4m ca4m on c.code = ca4m.code
WHERE c.stock_price <= ca4m.chosen_price + 2000
  AND c.roic >= 0.1
  AND ca4m.nopat_grow_rate >= 0.1
  AND ca4m.net_income_grow_rate >= 0.1
  AND ca4m.equity_grow_rate >= 0.1
#   AND ca4m.operating_cash_flow_grow_rate >= 0.1
  AND c.code_industry = 3500
;

-- specified company
SELECT c.code,
       c.code_industry,
       c.market_cap,
       c.roic,
       ca4m.nopat_grow_rate,
       ca4m.net_income_grow_rate,
       ca4m.equity_grow_rate,
       ca4m.operating_cash_flow_grow_rate,
       c.stock_price,
       ca4m.mos_price,
       ca4m.graham_mos_price
FROM company c
         JOIN company_analysing_4m ca4m on c.code = ca4m.code
WHERE c.code = 'VNM';
