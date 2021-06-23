SELECT *
FROM company c
         JOIN company_analysing_4m ca4m on c.code = ca4m.code
WHERE c.stock_price <= ca4m.chosen_price + 2000
  AND c.roic >= 0.1
  AND ca4m.nopat_grow_rate >= 0.1
  AND ca4m.net_income_grow_rate >= 0.1
  AND ca4m.operating_cash_flow_grow_rate >= 0.1
  AND ca4m.equity_grow_rate >= 0.1
;
