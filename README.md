web_expense_tracker
simple web based expense tracker, based on example of farmer's women association example. 
In a month, the data is shown like this, similar to an Excel table
I am sorry, but I wrote this mostly for myself as a self-teaching, so the expressions are in finnish, below translation of the terms:


![expensetracker1](https://github.com/ReinhardLenz/web_expense_tracker/assets/71219487/0748fcb6-23ca-4ca9-aa6c-85ef030f1c26)





In the year sheet,some of the columns are editable (Income, Rent, Bank, Electricity, insurance). This is because income, electricity, and similar costs are month based, and normally would be filled out only rarely, maybe only at the end of the year. the rest is taken over from the month tables
By clicking Export button, an Excel file is generated, which can then be saved. The Excel has good tools to  generate beatiful charts.

![expensetracker2](https://github.com/ReinhardLenz/web_expense_tracker/assets/71219487/0d7d8827-a78f-487e-9c59-2cdf7bc097ec)


Month	Income	Food	Food	Rent	Traffic	Bank	Electricity	Insurance	Home	Recreation	Other	Result	Comments
Total
Average
/week



Submit

Export
Inspiration for this from the web page:

https://www.martat.fi/wp-content/uploads/2021/03/Budjetointivalineet-marttailtaan.pdf

Mysql database of month:



![expensetracker3](https://github.com/ReinhardLenz/web_expense_tracker/assets/71219487/3ef765ca-d5ba-4957-a846-d8d877e82949)



![expensetracker6](https://github.com/ReinhardLenz/web_expense_tracker/assets/71219487/1fac5e1a-4b17-431d-a4a6-ef4cfd9d690d)

Mysql database of year



![expensetracker5](https://github.com/ReinhardLenz/web_expense_tracker/assets/71219487/f124ad27-8924-4dff-8c45-05f343095227)


Dictionary:
Tulot: income
Asuminen:rent
nordea:Bank
Sähkö:electricity
vakuutukset: insurance
Ruokailu kotona:food at home
Ruokailu ulkona: food at restaurant
Liikenne: traffic
Kodin hankinnat: Purchases for home
virkistys: pleasure
muut menot: other expenses
tulos: result
Tammikuu: January
Helmikuu: February
Maaliskuu: March
huhtikuu: April
toukokuu: May
kesäkuu: June
heinäkuu: July
elokuu: August
syyskuu: September
Lokakuu: October
marraskuu: November
joulukuu: December
keskiarvo/viikko: average/week
keskiarvo/päivä: Average/day
ei painike painettu: no button pressed
Kuukausi on laitettu Elokuu: Month is set to August (The program is set so, that when the web page is opened, the 
program detects the actual month from computer date and sets the month to actual. But the month can still be changed
from the upper menue, in case I forgot to put something or if there is an expense upcoming in the future..

