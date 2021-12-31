<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap Font Icon CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href={{ URL::asset("/css/style.css") }}>

  {{-- DateRange Picker --}}
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

  {{-- Body BG --}}
  <style>
    body {
      background-image: url(/asset/skulls.png);
    }
  </style>

  {{-- H1 Style --}}

  {{-- <title>SHAS | {{ $title }}</title> --}}
  <title>SHAS</title>
</head>

<body class="bg-light">


  @include('partials.navbar')
  @include('partials.modal')
  <!-- Button trigger modal -->

  {{-- SHOW IMAGE MODAL --}}
  <script>
    $(document).ready(function() {
        $(document).on('click', '#view', function() {
            var name = $(this).data('name');
            var number_id = $(this).data('numberid');
            var time_start = $(this).data('timestart');
            var time_end = $(this).data('timeend');
            var temp = $(this).data('temp');
            var file_path = $(this).data('filepath');

            $('#name').text(name);
            $('#number-id').text(number_id);
            $('#time-start').text(time_start);
            console.log(time_start);
            $('#time-end').text(time_end);
            $('#temp').text(temp);
        
            if (file_path == "") {
                img_path = '/asset/no-pic.jpg';
            } else {
              img_path = {!! json_encode(asset("")) !!} + file_path;
            }
            $('#image').attr('src', img_path);
        });
    });
  </script>

  <div class="container mt-4">
    @yield('container')
  </div>


  <script>
    $(function () {
      $('#datetimepicker1').datetimepicker();
   });
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
  <script>
    $('.delete-confirm').click(function(event) {
      var form = $(this).closest("form");
      var name = $(this).data("name");
      event.preventDefault();
      swal({
        title: `Are you sure you want to delete ${name}?`,
        text: "If you delete this, it will be gone forever.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          form.submit();  
        }
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
  </script>

  <script>
    $(function() {
    $('input[name="datepicker"]').daterangepicker({
      "singleDatePicker": true,
      "showDropdowns": true,
      "minYear": 2020,
      "maxYear": 2021,
      // "timePicker": true,
      // "timePicker24Hour": true,
      // "startDate": "08/16/2021",
      // "endDate": "08/22/2021"
      }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD'));
        });
  });
  </script>

  <script>
    $(function() {
    $('input[id="timepicker"]').daterangepicker({
      "singleDatePicker": true,
      "showDropdowns": true,
      "minYear": 2020,
      "maxYear": 2021,
      "timePicker": true,
      "timePicker24Hour": true,
      "timePickerSeconds": true,
      // "startDate": "08/16/2021",
      // "endDate": "08/22/2021"
      }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD'));
        });
  });
  </script>

  <script>
    $(function() {
      $('input[id="datetimepicker"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: false,
        minYear: 2020,
        maxYear: 2021,
        timePicker: true,
        timePicker24Hour: true,
        timePickerSeconds: true,
        drops: 'up',
        opens: 'left',
        autoUpdateInput: false,
        locale: {
          cancelLabel: 'Clear',
          format: 'YYYY-MM-DD hh:mm:ss',
        
        }
        // "startDate": "08/16/2021",
        // "endDate": "08/22/2021"
      });

      $('input[id="datetimepicker"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm:ss'));
      });

      $('input[id="datetimepicker"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });
  
    });
  </script>

  {{-- LIVE CLOCK --}}
  <script>
    function showTime(){
  var date = new Date();
  var h = date.getHours(); // 0 - 23
  var m = date.getMinutes(); // 0 - 59
  var s = date.getSeconds(); // 0 - 59

  h = (h < 10) ? "0" + h : h;
  m = (m < 10) ? "0" + m : m;
  s = (s < 10) ? "0" + s : s;
  
  var time = h + ":" + m + ":" + s + " ";
  document.getElementById("MyClockDisplay").innerText = time;
  document.getElementById("MyClockDisplay").textContent = time;
  
  setTimeout(showTime, 1000);
  
}

showTime();
  </script>



  <script>
    $(function() {
    $('input[name="birthday"]').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minYear: 1901,
      maxYear: parseInt(moment().format('YYYY'),10)
    }, function(start, end, label) {
      var years = moment().diff(start, 'years');
      alert("You are " + years + " years old!");
    });
  });
  </script>
</body>

</html>