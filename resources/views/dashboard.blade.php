
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="{{asset('css/app.css')}}">
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body>



</body>

<style>
    
</style>

<x-app-layout>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 bg-white ">
                <br/>
                <div class="row">
                    <div class="col-md-6">
                    PLAYING CARD TEST
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-3" class="form-group form-focus">
                        <label class="focus-label">Insert Number of people</label>
                        <input type="number" class="form-control floating" id="numPeople" >
                        <label class="center"><span id='errorStatus'></span></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <a href="#" id="distribute_card" class="btn btn-primary btn-block " onclick="distribute()"> Submit </a>
                    </div>
                </div>
                </br>
                <div class="row">
                    <div  class="col-md-12 form-group form-focus">
                        <label class="focus-label">Result : </label><br>
                        <span id="result">no result</span>
                    </div>
                </div>
            </div>
        </div>
        <br/><br/>
    </div>

</x-app-layout>

<script>
    var distribute_route = "{{ route('distribute') }}";
    var list_row = 1;
    var CSRF_TOKEN = document.querySelector('meta[name=csrf-token]').getAttribute('content');

    function distribute() {

        numPeople = document.getElementById('numPeople').value;
        if (numPeople < 0 || numPeople == '' ) {
            $('#errorStatus').html('value is invalid').css('color', 'red');
            document.getElementById("result").innerHTML = 'no result';  
            return false;
        }else{
            $('#errorStatus').html('').css('color', '');
        }
        
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: distribute_route,
            data: { numPeople: numPeople},
            method: "POST",
            success: function (data) {

                document.getElementById("result").innerHTML = data.result;               

            }
        });

    

    }

</script>