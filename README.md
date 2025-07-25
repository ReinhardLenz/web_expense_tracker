📊 Web Expense Tracker
A simple web-based expense tracker, originally inspired by budgeting tools from the Farmer’s Women's Association. This tool allows monthly and yearly tracking of expenses, with automatic calculations and Excel export functionality. Built primarily as a self-learning project, the interface and labels are mostly in Finnish – a glossary is provided below.
________________________________________
🖼️ Screenshots
Monthly View
In each month view, data is displayed similarly to an Excel spreadsheet:



![expensetracker1](https://github.com/ReinhardLenz/web_expense_tracker/assets/71219487/0748fcb6-23ca-4ca9-aa6c-85ef030f1c26)




________________________________________
Yearly Overview
Some columns like Income, Rent, Bank, Electricity, and Insurance are editable directly in the year view. These fields typically change less frequently and are often filled in at the end of the year. All other data is aggregated from monthly entries.
Clicking the Export button generates an Excel file, which you can save and use for visualization:


![expensetracker2](https://github.com/ReinhardLenz/web_expense_tracker/assets/71219487/0d7d8827-a78f-487e-9c59-2cdf7bc097ec)

________________________________________
🧩 Features
•	✅ Monthly and yearly views of income and expenses
•	📝 Editable fields for key categories (income, rent, etc.)
•	📈 Excel export with structured formatting for easy charting
•	📅 Automatic detection of the current month on page load
•	📊 Data stored in MySQL tables for both month and year views
________________________________________
🗄️ Database Structure
Monthly Data (MySQL):



![expensetracker3](https://github.com/ReinhardLenz/web_expense_tracker/assets/71219487/3ef765ca-d5ba-4957-a846-d8d877e82949)



![expensetracker6](https://github.com/ReinhardLenz/web_expense_tracker/assets/71219487/1fac5e1a-4b17-431d-a4a6-ef4cfd9d690d)

Yearly Data (MySQL):


![expensetracker5](https://github.com/ReinhardLenz/web_expense_tracker/assets/71219487/f124ad27-8924-4dff-8c45-05f343095227)

🌐 Interface Terms (Finnish → English)
Finnish Term	English Translation
Tulot	Income
Asuminen	Rent
Nordea	Bank
Sähkö	Electricity
Vakuutukset	Insurance
Ruokailu kotona	Food at home
Ruokailu ulkona	Eating out
Liikenne	Traffic/Transport
Kodin hankinnat	Home purchases
Virkistys	Recreation
Muut menot	Other expenses
Tulos	Result
Keskiarvo/viikko	Average per week
Keskiarvo/päivä	Average per day
Ei painike painettu	No button pressed
Kuukausi on laitettu...	Month is set to...
Finnish Month Names
Finnish	English
Tammikuu	January
Helmikuu	February
Maaliskuu	March
Huhtikuu	April
Toukokuu	May
Kesäkuu	June
Heinäkuu	July
Elokuu	August
Syyskuu	September
Lokakuu	October
Marraskuu	November
Joulukuu	December
________________________________________
⚙️ How It Works
•	The app detects the current month on page load using the system date and automatically opens the relevant sheet.
•	Users can override this selection from the top menu if they need to update past or future data.
•	After submitting data, the Export button generates an Excel file for download.
•	The Excel file includes all data for the selected year and can be used to create charts and insights manually.
________________________________________
📚 Inspiration
This project was inspired by a budgeting guide from Martat.fi:
👉 Budjetointivälineet Marttailtaan (PDF)
________________________________________
📦 Technologies Used
•	HTML/CSS + JavaScript (Front-End)
•	PHP (Back-End logic)
•	MySQL (Data Storage)
•	Excel export via PHP or JavaScript libraries
________________________________________
🧠 Notes
This app was originally created for personal use and self-study. It's simple, but functional, and written primarily in Finnish to suit local use cases.

