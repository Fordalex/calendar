var months = [
    "January",
    "Febuaray",
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
function createMonthCalendar(year, month) {
    var monthDays = daysInMonth(year, month);
    var calendarDays = [];
    calendarDays.push('<div class="month-container">')
    calendarDays.push(`<h2>${months[month]}</h2>`)

    // Add the day titles at the top of the container.
    for (let i = 0; i < days.length; i++) {
        calendarDays.push(`<p class="day">${days[i]}</p>`)
    }
    // Add blank days to start the month off on the correct day.
    var blankDays = new Date(year, month, 1).getDay();
    for (let i = 0; i < blankDays; i++) {
        calendarDays.push(`<div class="day-container blank-day-container">.</div>`);
    }

    // Add the total days in the month.
    for (let i = 0; i < monthDays; i++) {
        calendarDays.push(`<div class="day-container" id="date-${i+1}-${month + 1}-${year}">${i + 1}</div>`);
    }

    // Add the conatiner to the page.
    calendarDays.push('</div>')
    $('#dateContainer').append(calendarDays.join(""));
}

// Return the number of days in that month.
function daysInMonth(year, month) {
    return new Date(year, month + 1, 0).getDate();
}