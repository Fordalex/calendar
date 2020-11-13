var months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
]

var days = [
    "Sun",
    "Mon",
    "Tues",
    "Wed",
    "Thur",
    "Fri",
    "Sat",
]

// Add days to a month container and append the the dateContainer.
function createMonthCalendar(year, month, redirect) {
    var monthDays = daysInMonth(year, month);
    var calendarDays = [];

    calendarDays.push('<div class="month-container">');
    calendarDays.push(`<h2>${months[month]}</h2>`)

    // Add the day titles at the top of the container.
    for (let i = 0; i < days.length; i++) {
        calendarDays.push(`<p class="day">${days[i]}</p>`)
    }
    // Add blank days to start the month off on the correct day.
    var blankDays = new Date(year, month, 1).getDay();
    for (let i = 0; i < blankDays; i++) {
        calendarDays.push(`<div class="day-container blank-day-container"><span></span></div>`);
    }

    // Add the total days in the month.
    month++;
    if (month.toString().length < 2) {
        month = "0" + month;
    }
    for (let i = 0; i < monthDays; i++) {
        day = i + 1;
        if (day.toString().length < 2) {
            day = "0" + day;
        }
        calendarDays.push(`<a class="day-container" id="date-${year}-${month}-${day}" href="forms/set_date.php?date=${year}-${month}-${day}&redirect=${redirect}"><span><b>${day}</b></span></a>`);
    }

    // Add the conatiner to the page.
    calendarDays.push('</div>')
    $('#dateContainer').append(calendarDays.join(""));
    findToday();
}

// Return the number of days in that month.
function daysInMonth(year, month) {
    return new Date(year, month + 1, 0).getDate();
}

function findToday() {
    // Style set days/holidays.
    var today = new Date();
    var day = today.getDate();
    var month = today.getMonth() + 1;
    var year = today.getFullYear();
    if (month.toString().length < 2) {
        month = "0" + month;
    }
    if (day.toString().length < 2) {
        day = "0" + day;
    }
    var todayId = `#date-${year}-${month}-${day}`;

    $(todayId).addClass('today');
}