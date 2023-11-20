<script src="{{ asset('admin/dist/js/index.global.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    function calculateEnd(startTime, duration, start_date) {
        var startTimeParts = startTime.split(":");
        var durationParts = duration.split(":");

        var startHours = parseInt(startTimeParts[0]);
        var startMinutes = parseInt(startTimeParts[1]);
        var startSeconds = parseInt(startTimeParts[2]);

        var durationHours = parseInt(durationParts[0]);
        var durationMinutes = parseInt(durationParts[1]);
        var durationSeconds = parseInt(durationParts[2]);

        var totalStartSeconds = startHours * 3600 + startMinutes * 60 + startSeconds;
        var totalDurationSeconds = durationHours * 3600 + durationMinutes * 60 + durationSeconds;

        var totalSeconds = (totalStartSeconds + totalDurationSeconds) % (24 * 3600);
        var totalDays = Math.floor((totalStartSeconds + totalDurationSeconds) / (24 * 3600));

        var endHours = Math.floor(totalSeconds / 3600);
        var endMinutes = Math.floor((totalSeconds % 3600) / 60);
        var endSeconds = totalSeconds % 60;

        var endDate = new Date(start_date);
        endDate.setDate(endDate.getDate() + totalDays);

        return (
            endDate.toISOString().split("T")[0] +
            " " +
            ("0" + endHours).slice(-2) +
            ":" +
            ("0" + endMinutes).slice(-2) +
            ":" +
            ("0" + endSeconds).slice(-2)
        );
    }
    function calculateEndTime(startTime, duration) {
    var startTimeParts = startTime.split(":");
    var durationParts = duration.split(":");

    var startHours = parseInt(startTimeParts[0]);
    var startMinutes = parseInt(startTimeParts[1]);
    var startSeconds = parseInt(startTimeParts[2]);

    var durationHours = parseInt(durationParts[0]);
    var durationMinutes = parseInt(durationParts[1]);
    var durationSeconds = parseInt(durationParts[2]);

    var totalStartSeconds = startHours * 3600 + startMinutes * 60 + startSeconds;
    var totalDurationSeconds = durationHours * 3600 + durationMinutes * 60 + durationSeconds;

    var totalSeconds = (totalStartSeconds + totalDurationSeconds) % (24 * 3600);

    var endHours = Math.floor(totalSeconds / 3600);
    var endMinutes = Math.floor((totalSeconds % 3600) / 60);
    var endSeconds = totalSeconds % 60;

    return (
        ("0" + endHours).slice(-2) +
        ":" +
        ("0" + endMinutes).slice(-2)+
        ":" +
        ("0" + endSeconds).slice(-2)
    );
}
    var schedule = <?php echo json_encode($trip); ?>;
    document.addEventListener('DOMContentLoaded', function() {

        var events = [];
        for (let i = 0; i < schedule.length; i++) {
            var start_time = schedule[i]['start_time']
            var interval_time = schedule[i]['interval_trip']
            var start_date = moment(schedule[i]['start_date']).format('YYYY-MM-DD')
            var end_time = calculateEndTime(start_time,interval_time)
            var end = calculateEnd(start_time,interval_time,start_date)
            let event = {
                title: `${schedule[i]['start_location']} - ${schedule[i]['end_location']} (${start_time} - ${end_time})`,
                start: `${start_date}T${start_time}`,
                end: `${end}`,
                color: "#257e4a",
            };
            events.push(event);
        }
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: "vi",
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            initialDate: moment(new Date()).format('YYYY-MM-DD'),
            navLinks: true, // can click day/week names to navigate views
            businessHours: false, // display business hours
            editable: false,
            selectable: false,
            nowIndicator: true,
            events: events
        });

        calendar.render();
    });
</script>
