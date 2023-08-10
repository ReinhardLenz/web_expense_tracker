# web_expense_tracker
simple web based expense tracker, based on example of farmer's women association example. 
In a month, the data is shown like this, similar to an Excel table


Jan Feb Mar Apr May Jun Jul Aug Sept Oct Nov Dec Year

Day    Food  Food  Traffic  Home  recreation  other  comment
       home  
tue,1  0      0      5      0      0          0      ticket
wed,2  10     0      0      0      0          0      Flour
thu,3  0      10     0      0      0          0      Restaurant
fri,4  0      0      0      3      0          0      Toilet paper
.....

thu,30 0      0      0      0      5          0      Cinema
Sum           10     5      3      5          0
Avg/day        0.33  0.1    0.1    0.3        0  

Submit

delete


In the year sheet,some of the columns are editable (Income, Rent, Bank, Electricity, insurance) , the rest is taken over from the month tables
By clicking Export button, an Excel file is generated, which can then be saved

Month	Income	Food	Food	Rent	Traffic	Bank	Electricity	Insurance	Home	Recreation	Other	Result	Comments
Jan	  0	       0	  100	   0	   0	    0	     0		      0		      0	     0		       0	   0	     ...
Feb	  0	       0	  0  	   0	   0	    0	     0		      0		      0	     0		       0	   0	     ...
Mar		0	       0	  0  	   0	   0	    0	     0		      0		      500	   0		       0	   0	     ...


etc
	...	...	...	...	...	...	...		...		...	...		...	...	
Dec		0	       0	  0  	   0	   0	    0	     500	     0		      0	   0		       50	   0	     ...
----------------------------------------------------------------------------------------------------------------------------------------------
Total	0	       0	  100	   0	   0	    0	     500	     0		      500   0		       50	   0	     ...
Average
/week	0	      0	    2	     0	   0	    0	     5.7		    0		      9.6	   0		      1	    0

Submit

Export






