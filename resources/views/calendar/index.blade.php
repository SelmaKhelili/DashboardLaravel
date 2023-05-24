<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard- Calendar</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Fonts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>
        <div class="modal fade" id="bookingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" id="md">
              
            </div>
          </div>
        <div class="container">
            <div c8lass="row">
                <div class="col-12">
                    <h2 class="text-center mt-5">Dashboard  -   Calendar</h2>
                    <div class="col-md-11 offset-1 mt-5 mb-5">

                        <div id="calendar">
    
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

<script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var booking = @json($events);
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay',
                },
                events: booking,
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDays) {
                    document.getElementById('md').innerHTML = '<div class="modal-content">\
                <div class="modal-header">\
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Event title</h1>\
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>\
                </div>\
                <div class="modal-body">\
                    <h4  class="fs-5">Enter the title of your event</h4>\
                  <input type="text" class="form-control" id="title" >\
                  <span id="titleError" class="text-danger"></span>\
                </div>\
                <div class="modal-footer">\
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>\
                  <button type="button" class="btn btn-primary" id="saveBtn">Save Event</button>\
                </div>\
              </div>\
            </div>'
                    $('#bookingModal').modal('toggle');
                    $('#saveBtn').click(function() {
                        var title = $('#title').val();
                        var start_date = moment(start).format('YYYY-MM-DD');
                        var end_date = moment(end).format('YYYY-MM-DD');
                        $.ajax({
                            url:"{{ route('calendar.store') }}",
                            type:"POST",
                            dataType:'json',
                            data:{ title, start_date, end_date  },
                            success:function(response)
                            {
                                $('#bookingModal').modal('hide')
                                $('#calendar').fullCalendar('renderEvent', {
                                    'title': response.title,
                                    'start' : response.start_date,
                                    'end'  : response.end_date
                                });
                            },
                            error:function(error)
                            {
                                if(error.responseJSON.errors) {
                                    console.log(error.responseText);
                                }
                            },
                        });
                    });
                },
              
                editable:true,
                eventDrop: function(event) {
                var id = event.id;
                var start_date = moment(event.start).format('YYYY-MM-DD');
                var end_date = moment(event.end).format('YYYY-MM-DD');
                $.ajax({
                    url:"{{ route('calendar.update', '') }}" + '/' + id,
                    type: "PATCH", 
                    dataType: 'json',
                    data: { start_date, end_date },
                    success: function(response) {
                        Swal.fire({
                            title: 'Event updated successfully !',
                            width: 600,
                            padding: '3em',
                            color: '#716add',
                            background: '#fff url(/images/trees.png)',
                            backdrop: `
                                rgba(0,0,123,0.4)
                                url("/assets/img/gif/nyan-cat.gif")
                                left top
                                no-repeat
                            `
                            })
                           
                        //swal('Good job!','Event updated successfully','success');
                    },
                    error: function(error) {
                        console.log(error)
                    },
                });
            },

            eventClick:function(event)
            {
                    var id = event.id;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                     $.ajax({
                    url:"{{ route('calendar.destroy', '') }}" + '/' + id,
                    type: "DELETE", 
                    dataType: 'json',
                    success: function(response) {
                      
                    },
                    error: function(error) {
                        console.log(error)
                    },

            });
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                    $('#calendar').fullCalendar('renderEvent', {
                                    'title': response.title,
                                    'start' : response.start_date,
                                    'end'  : response.end_date
                                });
  }
})
        },


            })
        })
            
            
 </script>
    </body>
</html>