


@extends('layouts.frontend')

@section('content')

<div class="container places">
    <h1 class="text-center">Room in <a href="{{ route('object',['room'=>$room->object_id]) }}">{{ $room->object->name  }}</a> object</h1>

    @foreach( $room->photos->chunk(3) as $chunked_photos ) 

        <div class="row top-buffer">
            
            @foreach($chunked_photos as $photo) 
            
            <div class="col-md-4">
                <img class="img-responsive" src="{{ $photo->path ?? $placeholder  }}" alt="">
            </div>
            
            @endforeach 

        </div>

   @endforeach 


     <section>

        <ul class="list-group">
            <li class="list-group-item">
                <span class="bolded">Description:</span> {{ $room->description  }}
            </li>
            <li class="list-group-item">
                <span class="bolded">Room size:</span> {{ $room->room_size  }}
            </li>
            <li class="list-group-item">
                <span class="bolded">Price per night:</span> {{ $room->price  }} USD
            </li>
            <li class="list-group-item">
            <span class="bolded">Address:</span> {{ $room->object->city->name }} {{ $room->object->address->street  }} nr {{ $room->object->address->number  }}
            </li>
        </ul>
    </section>

    <section id="reservation">

        <h3>Reservation</h3>

        <div class="row">
            <div class="col-md-6">
                <form method="POST">
                    <div class="form-group">
                        <label for="checkin">Check in</label>
                        <input required name="checkin" type="text" class="form-control datepicker" id="checkin" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="checkout">Check out</label>
                        <input required name="checkout" type="text" class="form-control datepicker" id="checkout" placeholder="">
                    </div>
                    <button type="submit" class="btn btn-primary">Book</button> 
                    <p class="text-danger">There are no vacancies</p>
                </form>
            </div><br>
            <div class="col-md-6">
                <div id="avaiability_calendar"></div>
            </div>
        </div>


    </section>

</div>


@endsection

@push('scripts')


<script>


function datesBetween(startDt, endDt) {
    var between = [];
    var currentDate = new Date(startDt);
    var end = new Date(endDt);
    while (currentDate <= end)
    {
        between.push( $.datepicker.formatDate('mm/dd/yy',new Date(currentDate)) );
        currentDate.setDate(currentDate.getDate() + 1);
    }

        return between;
}

    
$.ajax({

    cache: false,
    url: base_url + '/ajaxGetRoomReservations/' + {{ $room->id }},
    type: "GET",
    success: function(response){


        const eventDates = {};
        let dates = [];
        //var dates = ['02/15/2018', '02/16/2018', '02/25/2018'];
        // for (var i = 0; i <= dates.length; i++)
        // {
        //     eventDates[ new Date(dates[i])] = new Date(dates[i]);
        // }


         for(var i = 0; i <= response.reservations.length - 1; i++)
        {
            dates.push(datesBetween(new Date(response.reservations[i].day_in), new Date(response.reservations[i].day_out))); // array of arrays
        }

        dates = [].concat.apply([], dates);    // flattened array


        for (var i = 0; i <= dates.length - 1; i++)
        {
            eventDates[dates[i]] = dates[i];
        }


        $(function () {
            $("#avaiability_calendar").datepicker({
                onSelect: function (data) {

                   console.log($('#checkin').val());

                    if ($('#checkin').val() == '')
                    {
                        $('#checkin').val(data);
                    } else if ($('#checkout').val() == '')
                    {
                        $('#checkout').val(data);
                    } else if ($('#checkout').val() != '')
                    {
                        $('#checkin').val(data);
                        $('#checkout').val('');
                    }

                },
                beforeShowDay: function (date)
                {
                    var tmp =  eventDates[$.datepicker.formatDate('mm/dd/yy', date)]; 
                    //console.log(date);
                    if (tmp)
                        return [false, 'unavaiable_date'];
                    else
                        return [true, ''];
                }


            });
        });


    }


});


    
</script>

@endpush