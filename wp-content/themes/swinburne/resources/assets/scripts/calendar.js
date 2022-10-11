$(document).ready(function() {
    
    var d = new Date();

    var Calendar = {
        themonth: d.getMonth(), // The number of the month 0-11
        theyear: d.getFullYear(), // This year
        today: [d.getFullYear(), d.getMonth(), d.getDate()], // adds today style
        selectedDate: null, // set to today in init()
        years: [], // populated with last 10 years in init()
        months: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],

        init: function() {
            this.selectedDate = this.today
            // Populate the list of years in the month/year pulldown
            var year = this.theyear;
            for (var i = 0; i < 10; i++) {
                this.years.push(year--);
            }

            this.bindUIActions();
            this.render();
        },

        bindUIActions: function() {
            // Create Years list and add to ympicker
            for (var i = 0; i < this.years.length; i++)
                $('<li>' + this.years[i] + '</li>').appendTo('.calendar-ympicker-years');
            this.selectMonth();
            this.selectYear(); // Add active_date class to current month n year
            // Move calander to today
            $('.today').click(function() {
                Calendar.themonth = d.getMonth();
                Calendar.theyear = d.getFullYear();
                Calendar.selectMonth();
                Calendar.selectYear();
                Calendar.selectedDate = Calendar.today;
                Calendar.render();
                $('.calendar-ympicker').css('transform', 'translateY(-100%)');
            });

            // Click handlers for ympicker list items
            $('.calendar-ympicker-months li').click(function() {
                Calendar.themonth = $('.calendar-ympicker-months li').index($(this));
                Calendar.selectMonth();
                Calendar.render();
                $('.calendar-ympicker').css('transform', 'translateY(-100%)');
            });
            $('.calendar-ympicker-years li').click(function() {
                Calendar.theyear = parseInt($(this).text());
                Calendar.selectYear();
                Calendar.render();
            });

            // Move the calendar pages
            $('.minusmonth').click(function() {
                Calendar.themonth += -1;
                Calendar.changeMonth();
            });
            $('.addmonth').click(function() {
                Calendar.themonth += 1;
                Calendar.changeMonth();
            });
        },

        // Adds class="active_date" to the selected month/year
        selectMonth: function() {
            $('.calendar-ympicker-months li').removeClass('no-class');
            $('.calendar-ympicker-months li:nth-child(' + (this.themonth + 1) + ')').addClass('no-class');
        },
        selectYear: function() {
            $('.calendar-ympicker-years li').removeClass('active_year');
            $('.calendar-ympicker-years li:nth-child(' + (this.years.indexOf(this.theyear) + 1) + ')').addClass('active_year');
        },

        // Makes sure that month rolls over years correctly
        changeMonth: function() {
            if (this.themonth == 12) {
                this.themonth = 0;
                this.theyear++;
                this.selectYear();
            } else if (this.themonth == -1) {
                this.themonth = 11;
                this.theyear--;
                this.selectYear();
            }
            this.selectMonth();
            this.render();
        },

        // Helper functions for time calculations
        TimeCalc: {
            firstDay: function(month, year) {
                var fday = new Date(year, month, 1).getDay(); // Mon 1 ... Sat 6, Sun 0
                if (fday === 0) fday = 7;
                return fday - 1; // Mon 0 ... Sat 5, Sun 6
            },
            numDays: function(month, year) {
                return new Date(year, month + 1, 0).getDate(); // Day 0 is the last day in the previous month
            }
        },

        render: function() {
            var days = this.TimeCalc.numDays(this.themonth, this.theyear), // get number of days in the month
                fDay = this.TimeCalc.firstDay(this.themonth, this.theyear), // find what day of the week the 1st lands on        
                daysHTML = '',
                i;

            $('.calendar p.monthname').text(this.months[this.themonth] + '  ' + this.theyear); // add month name and year to calendar
            for (i = 0; i < fDay; i++) { // place the first day of the month in the correct position
                daysHTML += '<li class="noclick">&nbsp;</li>';
            }
            // write out the days
            for (i = 1; i <= days; i++) {
                if (this.today[0] == this.selectedDate[0] &&
                    this.today[1] == this.selectedDate[1] &&
                    this.today[2] == this.selectedDate[2] &&
                    this.today[0] == this.theyear &&
                    this.today[1] == this.themonth &&
                    this.today[2] == i)
                    daysHTML += '<li class="today">' + i + '</li>';
                else if (this.today[0] == this.theyear &&
                    this.today[1] == this.themonth &&
                    this.today[2] == i)
                    daysHTML += '<li class="today">' + i + '</li>';
                else if (this.selectedDate[0] == this.theyear &&
                    this.selectedDate[1] == this.themonth &&
                    this.selectedDate[2] == i)
                    daysHTML += '<li class="no_day">' + i + '</li>';
                else
                    daysHTML += '<li>' + i + '</li>';

                $('.calendar-body').html(daysHTML); // Only one append call
            }

            // Adds active_date class to date when clicked
            $('.calendar_body li').click(function() { // toggle selected dates
                if (!$(this).hasClass('noclick')) {
                    $('.calendar_body li').removeClass('active_date');
                    $(this).addClass('calendar-body active_date');
                    var pathname = window.location.pathname + '?date=10&month=12&year=2019';

                    Calendar.selectedDate = [Calendar.theyear, Calendar.themonth, $(this).text()]; // save date for reselecting
                }
            });
        }
    };
    Calendar.init();
});
$(document).ready(function() {
    var pathname = window.location.href;
    $('.calendar').click(function() {
        var month_and_years = document.getElementsByClassName('monthname')['0'];
        var string_dmonth = month_and_years.textContent;
        var array_dmonth = string_dmonth.split(" ");
        var li_element = document.getElementsByClassName('active_date')['0'];
        if (li_element) {
            var current_day = li_element.textContent;
            var current_year = array_dmonth['2'];
            var current_month = array_dmonth['0'];
            // console.log(current_day);
            // console.log(current_year);
            // console.log(current_month);
            // console.log(li_element);
            var pathname = window.location.pathname + `/?date=${current_year}-${current_month}-${current_day}`;
            console.log(pathname);
            window.location.href = pathname;
        }


    });
})