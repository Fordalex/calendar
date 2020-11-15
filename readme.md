# Calendar

I'm creating a calendar connected to a database to get used to hosting a php project on heroku.

View project [Link](https://daily-todo-calendar.herokuapp.com/user_profile/login.php)

## UX

The layout of this project is broken up into a few sections, First the user will need to make and accont to use the application. After, the user will be able to create their own calendar to keep track of their life chores/goals or anything they wish. I'll be adding a functionality where users can add friends to share/compete with each other to see who can do the most. Graphs will be shown to give the users all the inforamtion they will need to improve their goals, different categories of calendars will be able to be tracked also. This will allow the user to progress/track in all area's of their life.

### Bugs

- When creating an event, if the input has "'" the data won't save to the database.
- If a date isn't saved in the session the yearly and monthly calendar won't be displayed.

### Left to implement

- Need to give the user the ability to repeat an event yearly or it be a one time occasion.
- Add a carousel for the monthly calendar view.

### Acknowledgements

- [Hosting on heroku](https://www.youtube.com/watch?v=LXb6f8GJ0qs)
- [Login System](https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php)