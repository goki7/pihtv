$(document).ready(() => {
    $('#external-events .fc-event').each(function() {
        // store data so the calendar knows to render an event upon drop
        $(this).data('event', {
            title: $.trim($(this).text()), // use the element's text as the event title
            stick: true // maintain when user navigates (see docs on the renderEvent method)
        });

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true, // will cause the event to go back to its
            revertDuration: 0 //  original position after the drag
        });
    });

    const urlParam = new URLSearchParams(window.location.search);
    const id_presentazione = urlParam.get("id_presentazione");
    let calendar = $("#calendar").fullCalendar({
        themeSystem: 'bootstrap4',
        editable: true,
        header: {
            left: 'prev, next, today',
            center: 'title',
            right: 'agendaDay, agendaWeek, month'
        },
        defaultView: "agendaWeek",
        // hiddenDays: [0],
        // minTime: "07:40:00",
        // maxTime: "16:00:00",
        nowIndicator: true,
        events: '/admin/programmazione/load.php?id_presentazione=' + id_presentazione,
        selectable: true,
        selectHelper: true,
        droppable: true,
        // eventOverlap: false,
        navLinks: true,
        agendaEventMinHeight: 20,

        // slotDuration: "00:05:00",
        
        eventDrop: event => {
            const id = event.id;
            let s = new Date(event.start);
            let e = new Date(event.end);
            let orario_inizio = (s.getHours() - 2) + ":" + s.getMinutes() + ":" + s.getSeconds();
            let orario_fine = (e.getHours()) + ":" + e.getMinutes() + ":" + e.getSeconds();
            let data_inizio = s.getFullYear() + "-" + (s.getMonth() + 1) + "-" + s.getDate();
            let data_fine= e.getFullYear() + "-" + (e.getMonth() + 1) + "-" + e.getDate();

            fetch(`/admin/programmazione/update.php`, {
                method: "POST",
                body: JSON.stringify({id,
                    data_inizio,
                    data_fine,
                    orario_inizio,
                    orario_fine
                })
            });
        },

        drop: (date, jsEvent, _ui, _resourceId) => {
            let s = new Date(date.toDate());
            let e = new Date(date.toDate());
            let orario_inizio = (s.getHours() - 2) + ":" + s.getMinutes() + ":" + s.getSeconds();
            let orario_fine = (e.getHours()) + ":" + e.getMinutes() + ":" + e.getSeconds();
            let start = s.getFullYear() + "-" + (s.getMonth() + 1) + "-" + s.getDate();
            let end = e.getFullYear() + "-" + (e.getMonth() + 1) + "-" + e.getDate();
            let id_presentazione = jsEvent.target.id;

            fetch("/admin/programmazione/create.php", {
                method: "POST",
                body: JSON.stringify({
                    start,
                    end,
                    orario_inizio,
                    orario_fine,
                    id_presentazione
                })
            });
        },

        eventResize: event => {
            const id = event.id;
            let s = new Date(event.start);
            let e = new Date(event.end);
            let orario_inizio = (s.getHours() - 2) + ":" + s.getMinutes() + ":" + s.getSeconds();
            let orario_fine = (e.getHours()) + ":" + e.getMinutes() + ":" + e.getSeconds();
            let data_inizio = s.getFullYear() + "-" + (s.getMonth() + 1) + "-" + s.getDate();
            let data_fine = e.getFullYear() + "-" + (e.getMonth() + 1) + "-" + e.getDate();

            fetch(`/admin/programmazione/update.php`, {
                method: "POST",
                body: JSON.stringify({id,
                    data_inizio,
                    data_fine,
                    orario_inizio, 
                    orario_fine 
                })
            });
        },

        eventClick: event => {
            $(".container").append(`
                <div class="modal fade" id="modale${event.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Evento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="/admin/programmazione/update.php?id=${event.id}">
                                    <div class="form-group">
                                        <label for="data_inizio">Data Inizio</label>
                                        <input class="form-control" type="date" name="data_inizio" id="data_inizio" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="data_fine">Data Fine</label>
                                        <input class="form-control" type="date" name="data_fine" id="data_fine" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="orario_inizio">Orario Inizio</label>
                                        <input class="form-control" type="time" name="orario_inizio" id="orario_inizio" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="orario_fine">Orario Fine</label>
                                        <input class="form-control" type="time" name="orario_fine" id="orario_fine" required>
                                    </div>
                                    <button type="submit" name="id" class="btn btn-primary">Modifica</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <form method="POST" action="/admin/programmazione/delete.php"><button value="${event.id}" name="id" type="submit" class="btn btn-danger">Elimina</button></form>
                            </div>
                        </div>
                    </div>
                </div>
            `);

            const modale = $(`#modale${event.id}`).modal();


        }
    });
});