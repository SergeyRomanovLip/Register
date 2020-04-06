# Register
The entrance register for coronavirus period

My plant doesn't have a card pass system. It means that every morning and evening it's crowded on the reception.
We decided to make a simple JS app with also simple sql base.

It works by the next way:
1. There is a base of employees with canteen cards numbers
2. When somebody want to go inside or outside he should put his canteen card number into this app.
3. App check him in system, check simple logic mistakes (he isn't able to go inside twice without go outside) and app make a new row in sql register.
4. You can print a list of employees who is inside plant in case of emergency.
