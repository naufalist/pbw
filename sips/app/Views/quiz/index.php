<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <!-- Font GoogleApis -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <title>Quiz</title>

    <script>

      function startQuiz() {
        // window.open('http://localhost/quiz.php','mywin', "width="+screen.availWidth+",height="+screen.availHeight);
        hide("info");
        show("quiz");
        show("time");
        $("#startQuizModal").modal('hide');
        
        let inputId = ["#net_add", "#mx_add", "#fh_add", "#lh_add", "#bc_add"];

        inputId.forEach(element => {
          $(element).val("");
          $(element).attr("class", "form-control");
          $(element + "_ans").empty();
        });
        $("#submit_btn").prop('disabled', false);
        
        interval = window.setInterval(stopWatch, 1000);
        // status = "started";
      }

      function stopQuiz() {

        // const csrfName = $('.csrf_token').attr('name'); // CSRF Token name
        // const csrfHash = $('.csrf_token').val(); // CSRF hash

        $.ajax({
          url:'<?= site_url('/quiz'); ?>',
          method: 'post',
          data: {
            waktu: localStorage.getItem('time'),
            skor: localStorage.getItem('score'),
            // [csrfName]: csrfHash
          },
          dataType: 'json',
          success:function(data)    {
            console.log(data);
          }  
          // success: function(response){
          //   var len = response.length;
          //   $('#suname,#sname,#semail').text('');
          //   if(len > 0){
          //     // Read values
          //     var uname = response[0].username;
          //     var name = response[0].name;
          //     var email = response[0].email;
      
          //     $('#suname').text(uname);
          //     $('#sname').text(name);
          //     $('#semail').text(email);         
          // }
        })

        show("info");
        hide("quiz");
        hide("time");

        // status = "stopped";
        
        window.clearInterval(interval);
        seconds = 0;
        minutes = 0;
        hours = 0;
        document.getElementById("display").innerHTML = "00:00:00";
        // document.getElementById("startStop").innerHTML = "Start";
        // //
        document.getElementById("score").innerHTML = "0";

        console.log("score: "+localStorage.getItem('score')+" time: "+localStorage.getItem('time'));

        if (localStorage.getItem('score') && localStorage.getItem('time')) {
          $("#last_score").html(localStorage.getItem('score'));
          $("#time_elapsed").html(localStorage.getItem('time'));
          show("result");
        } else {
          $("#last_score").html('');
          $("#time_elapsed").html('');
          hide("result");
        }

        localStorage.clear();

      }

      function hide(x) {
           document.getElementById(x).style.display = "none";
          //  document.getElementById(x).classList.add("hidden");
       }
      function show(x) {
           document.getElementById(x).style.display = null;
           //document.getElementById(x).removeAttribute("style");
          //  document.getElementById(x).classList.remove("hidden");
       }
    </script>
    
    <script>
      window.onload = function(){
        if (localStorage.getItem('time')) {
            document.getElementById("display").innerHTML = localStorage.getItem('time');

          // hide("result");
          hide("info");
          show("quiz");
          show("time");
          $("#startQuizModal").modal('hide');

            // window.clearInterval(interval);
            interval = window.setInterval(stopWatch, 1000);
            // document.getElementById("startStop").innerHTML = "Stop";
            // status = "started";
        }
      }
    </script>
    
    <script>

        //Define vars to hold time values
        let seconds = localStorage.getItem('seconds') ? localStorage.getItem('seconds') : 0;
        let minutes = localStorage.getItem('minutes') ? localStorage.getItem('minutes') : 0;
        let hours = localStorage.getItem('hours') ? localStorage.getItem('hours') : 0;
        // let seconds = 0;
        // let minutes = 0;
        // let hours = 0;

        //Define vars to hold "display" value
        let displaySeconds = 0;
        let displayMinutes = 0;
        let displayHours = 0;

        //Define var to hold setInterval() function
        let interval = null;

        //Define var to hold stopwatch status
        let status = "stopped";

        //Stopwatch function (logic to determine when to increment next value, etc.)
        function stopWatch(){

            seconds++;

            //Logic to determine when to increment next value
            if(seconds / 60 === 1){
                seconds = 0;
                minutes++;

                if(minutes / 60 === 1){
                    minutes = 0;
                    hours++;
                }

            }

            //If seconds/minutes/hours are only one digit, add a leading 0 to the value
            if(seconds < 10){
                displaySeconds = "0" + seconds.toString();
            }
            else{
                displaySeconds = seconds;
            }

            if(minutes < 10){
                displayMinutes = "0" + minutes.toString();
            }
            else{
                displayMinutes = minutes;
            }

            if(hours < 10){
                displayHours = "0" + hours.toString();
            }
            else{
                displayHours = hours;
            }

            localStorage.setItem('seconds', seconds);
            localStorage.setItem('minutes', minutes);
            localStorage.setItem('hours', hours);

            localStorage.setItem('time', displayHours + ":" + displayMinutes + ":" + displaySeconds);

            //Display updated time values to user
            document.getElementById("display").innerHTML = displayHours + ":" + displayMinutes + ":" + displaySeconds;
            // document.getElementById("display").innerHTML = localStorage.getItem('seconds') + ":" + localStorage.getItem('minutes') + ":" + localStorage.getItem('hours');

        }

        function startStop(){

            if(status === "stopped"){

                //Start the stopwatch (by calling the setInterval() function)
                interval = window.setInterval(stopWatch, 1000);
                document.getElementById("startStop").innerHTML = "Stop";
                status = "started";

            }
            else{

                window.clearInterval(interval);
                document.getElementById("startStop").innerHTML = "Start";
                status = "stopped";

            }

        }

        //Function to reset the stopwatch
        function reset(){

            window.clearInterval(interval);
            seconds = 0;
            minutes = 0;
            hours = 0;
            document.getElementById("display").innerHTML = "00:00:00";
            document.getElementById("startStop").innerHTML = "Start";

            localStorage.clear();

        }
    </script>

    <script>
      $("html").mouseleave(function() {
        // alert("Peringatan! Jangan Coba Membuka Tab/Program Lain!");
        // location.reload();
        // $("#send").click();
      });
  
      var sA = [10,172,192],
          sB = [[0,255],[16,15],[167,168]],
          mN = [[8,7],[16,7],[24,6]],
          mI = [1,128,64,32,16,8,4,2,1,128,64,32,16,8,4,2,1,128,64,32,16,8,4];
      
      var rIP, mIP, mod, xIP, Ax, Bx, Cx, Dx, Fh, Lh, Bc;
      var trial = 0, score = 0, mode = "", count = 0, time, stat = 0;
      
      $(document).ready(function() {
          mode = $("#netclass option:selected").text();
          // $("#save_btn").prop('disabled', true);
          // $("#check_btn").prop('disabled', true);

          rand_ip();
            if (localStorage.getItem('score')) {
              document.getElementById("score").innerHTML = localStorage.getItem('score');
                // return rand_ip();
            } else {
              document.getElementById("result").style.display = "none";
            }

      });
      
      function rand_ip() {
        var A, B, C, D, M, i, rA;
        // var rA;
        // var rB, Rc, Rd;
        count = 0; stat = 0;

        temp_score = localStorage.getItem('score') ? localStorage.getItem('score') : 0;
          
        switch(Number($("#netclass option:selected").val())) {
          case 1 : rA = rand_index(0,0); mode = "A"; break;
          case 2 : rA = rand_index(0,1); mode = "B"; break;
          case 3 : rA = rand_index(1,2); mode = "C"; break;
          case 4 : rA = rand_index(0,2); mode = "A/B/C"; break;
        }

        let inputId = ["#net_add", "#mx_add", "#fh_add", "#lh_add", "#bc_add"];

        inputId.forEach(element => {
          $(element).val("");
          $(element).attr("class", "form-control");
          $(element + "_ans").empty();
        });
        
        $("#check_btn").prop('disabled', false);
        $("#submit_btn").prop('disabled', false);
        
        A = sA[rA];
        B = rand_index(sB[rA][0], sB[rA][1]);
        C = rand_index(0, 255);
        D = rand_index(0, 255);
        
        M = rand_index(mN[rA][0], mN[rA][1]);
        mod = mI[M-8];
        rIP = A+"."+B+"."+C+"."+D;
        
        if (M > 24 && M < 31)	{ // Segment D
          Ax = A; Bx = B; Cx = C;			
          Dx = find_net(D);
          mIP = "255.255.255."+(256-mod);
          Fh = Ax+"."+Bx+"."+Cx+"."+(Dx+1);
          Lh = Ax+"."+Bx+"."+Cx+"."+(Dx+mod-2);
          Bc = Ax+"."+Bx+"."+Cx+"."+(Dx+mod-1);
        }	
          
        if(M > 16 && M < 25) { //Segment C
          Ax = A; Bx = B; Dx = 0;			
          Cx = find_net(C);
          mIP = "255.255."+(256-mod)+".0";
          Fh = Ax+"."+Bx+"."+(Cx)+"."+(Dx+1);
          Lh = Ax+"."+Bx+"."+(Cx+mod-1)+"."+254;
          Bc = Ax+"."+Bx+"."+(Cx+mod-1)+"."+255;
        }	
        
        if(M > 8 && M < 17) {	//Segment B
          Ax = A; Cx = 0; Dx = 0;			
          Bx = find_net(B);
          mIP = "255."+(256-mod)+".0.0";
          Fh = Ax+"."+Bx+"."+Cx+"."+(Dx+1);
          Lh = Ax+"."+(Bx+mod-1)+"."+255+"."+254;
          Bc = Ax+"."+(Bx+mod-1)+"."+255+"."+255;
        }
        
        if(M == 8) { //Segment A
          Bx = 0; Cx = 0; Dx = 0;			
          Ax = A;
          mIP = "255.0.0.0";
          Fh = Ax+"."+Bx+"."+Cx+"."+(Dx+1);
          Lh = Ax+".255.255.254";
          Bc = Ax+".255.255.255";
        }	
          
        xIP = Ax+"."+Bx+"."+Cx+"."+Dx;
        // trial = 0; score = 0;
        $("#rand_ip").html(rIP+" /"+M);
        // $("#trial").html(trial);
        // $("#score").html(score);
        
        // time = setTimeout(second, 1000);
      }
      
      function second(){
        count++;
        time = setTimeout(second, 1000);
      }
      
      function rand_index(bot,top) {
        if (bot+1==top) {
          return top;
        } else {
          return Math.floor((Math.random()*(top+1))+bot);
        }
      }
      
      function find_net(x) {

        for (var i = x; i >= 0; i--) {
          if (i%mod == 0) {
            break;
          }
        }
        return i;

      }

      function submit() {

        if (!$("#net_add").val() ||
            !$("#mx_add").val() ||
            !$("#fh_add").val() ||
            !$("#lh_add").val() ||
            !$("#bc_add").val()) {
          $('#alert').modal('show')
          return;
        }

        temp_score = 0;
        var net = $("#net_add").val(),
            mx = $("#mx_add").val(),
            fh = $("#fh_add").val(),
            lh = $("#lh_add").val(),
            bc = $("#bc_add").val();
        
        if (net === xIP) {
          $("#net_add").addClass('is-valid');
          temp_score += 2;
        } else {
          $("#net_add").addClass('is-invalid');
          $("#net_add_ans").html(xIP);
        }
        
        if (mx === mIP) {
          $("#mx_add").addClass('is-valid');
          temp_score += 2;
        } else {
          $("#mx_add").addClass('is-invalid');
          $("#mx_add_ans").html(mIP);
        }
        
        if (fh === Fh) {
          $("#fh_add").addClass('is-valid');
          temp_score += 2;
        } else {
          $("#fh_add").addClass('is-invalid');
          $("#fh_add_ans").html(Fh);
        }
        
        if (lh === Lh) {
          $("#lh_add").addClass('is-valid');
          temp_score += 2;
        } else {
          $("#lh_add").addClass('is-invalid');
          $("#lh_add_ans").html(Lh);
        }
        
        if (bc === Bc) {
          $("#bc_add").addClass('is-valid');
          temp_score += 2;
        } else {
          $("#bc_add").addClass('is-invalid');
          $("#bc_add_ans").html(Bc);
        }

        if (localStorage.getItem('score')) {
          temp_score += parseInt(localStorage.getItem('score'));
        }

        localStorage.setItem('score', temp_score);
        $("#score").html(localStorage.getItem('score'));
        console.log(temp_score + "//" + localStorage.getItem('score'));

        $("#submit_btn").prop('disabled', true);

      }

      function resetLocal() {
        localStorage.clear();
      }
      
      function solve() {

        // localStorage.setItem('score', score);

        // stat = 1;
        $("#net_add").val(xIP);
        $("#mx_add").val(mIP);
        $("#fh_add").val(Fh);
        $("#lh_add").val(Lh);
        $("#bc_add").val(Bc);
        
        $("#net_add_icn").attr('class', 'fa fa-check');
        $("#mx_add_icn").attr('class', 'fa fa-check');
        $("#fh_add_icn").attr('class', 'fa fa-check');
        $("#lh_add_icn").attr('class', 'fa fa-check');
        $("#bc_add_icn").attr('class', 'fa fa-check');
        
        // $("#check_btn").prop('disabled', true);
        clearTimeout(time);
      }
      
      function check() {
        // score=0;
        var net = $("#net_add").val(),
            mx = $("#mx_add").val(),
            fh = $("#fh_add").val(),
            lh = $("#lh_add").val(),
            bc = $("#bc_add").val();
          
        if (net == xIP) {
          // $("#net_add_icn").attr('class', 'fa fa-check');
          $("#net_add").addClass('is-valid');
          // score += 20;
        } else {
          // score += 20;
          // $("#net_add_icn").attr('class', 'fa fa-close');
          $("#net_add").addClass('is-invalid');
          // $("#net_add").val(net + " // " + xIP);
          // $("#net_add_ans").html(xIP);
        }
        
        if (mx == mIP) {
          // $("#mx_add_icn").attr('class', 'fa fa-check');
          $("#mx_add").addClass('is-valid');
        } else {
          // $("#mx_add_icn").attr('class', 'fa fa-close');
          $("#mx_add").addClass('is-invalid');
          // $("#mx_add_ans").html(mIP);
        }
        
        if (fh == Fh) {
          // $("#fh_add_icn").attr('class', 'fa fa-check');
          $("#fh_add").addClass('is-valid');
        } else {
          // $("#fh_add_icn").attr('class', 'fa fa-close');
          $("#fh_add").addClass('is-invalid');
          // $("#fh_add_ans").html(Fh);
        }
        
        if (lh == Lh) {
          // $("#lh_add_icn").attr('class', 'fa fa-check');
          $("#lh_add").addClass('is-valid');
        } else {
          // $("#lh_add_icn").attr('class', 'fa fa-close');
          $("#lh_add").addClass('is-invalid');
          // $("#lh_add_ans").html(Lh);
        }
        
        if (bc == Bc) {
          // $("#bc_add_icn").attr('class', 'fa fa-check');
          $("#bc_add").addClass('is-valid');
        } else {
          // $("#bc_add_icn").attr('class', 'fa fa-close');
          $("#bc_add").addClass('is-invalid');
          // $("#bc_add_ans").html(Bc);
        }
        
        // trial++;
        // $("#trial").html(trial);
        // $("#score").html(score -= ((trial-1)*5));
        // score -= 10;
        // $("#score").html(score);


        // $("#save_btn").prop('disabled', false);
        // $("#check_btn").prop('disabled', true);
      }
      
      // function save_score() {
      // 	clearTimeout(time);
      // 	ID = prompt("Name/IDs");
      // 	$.get('funct.php?ID='+ID+"&val="+score+"&sec="+count+"&mod="+mode+"&try="+trial,{},
      // 		function(data) {
      // 		});	
      // 	$("#save_btn").prop('disabled', true);
      // }
      
      // function stateChange() {
      // 	if (stat == 0) {
      // 		$("#check_btn").prop('disabled', false);
      // 	}
      // }
        
    </script>

    <style>
      * { 
        font-family: 'Quicksand', sans-serif;
        font-size: 15px;
      }

      /* table {
        margin-left: auto;
        margin-right: auto;
      }

      tr {
        text-align: center;
      }

      #net_add_icn,
      #fh_add_icn,
      #mx_add_icn,
      #bc_add_icn,
      #lh_add_icn {
        font-size: 24px;
        color: white;
      } */
    </style>

</head>
<body>
  <div class="container mt-4">

<!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="startQuizModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Yakin mulai sekarang?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!-- <div class="modal-body">
            ...
          </div> -->
          <div class="modal-footer">
            <button onclick="startQuiz()" type="button" class="btn btn-danger">Yakin!</button>
            <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Belajar dulu deh kayaknya</button>
          </div>
        </div>
      </div>
    </div>


    <div id="info" class="row justify-content-center mb-5" style="display: null;">
      <div class="col col-md-9 col-lg-6">
        <div class="card text-center">
          <div class="card-header h3">
            Quiz
          </div>
          <div class="card-body">
            <!-- <h5 class="card-title">Cara bermain:</h5> -->
            <div class="card-text">
            <div id="result" class="alert alert-success alert-dismissible fade show text-left" role="alert">
              Quiz berakhir dengan skor <strong id="last_score"></strong> poin dalam waktu <strong id="time_elapsed"></strong>.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="alert alert-info text-left" role="alert">
              <h6 class="card-title font-weight-bold">Info:</h6>
              <ul class="mb-0">
                <li>Tekan tombol "<strong>Mulai</strong>" untuk memulai quiz.</li>
                <li>Semua kolom jawaban <strong>wajib diisi</strong>!</li>
                <li>Tekan tombol "<strong>Ubah Soal</strong>" untuk mengubah soal.</li>
                <li>Skor untuk tiap jawaban adalah 2 poin.</li>
                <li>Tekan tombol "<strong>Selesai</strong>" untuk mengakhiri quiz.</li>
              </ul>
            </div>
            </div>

            
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#startQuizModal">
            Mulai sekarang?
            </button>

            <!-- <button onclick="startQuiz()" class="btn btn-primary">Mulai sekarang!</button> -->
          </div>
          <div class="card-footer text-muted">
            <span class="text-muted">Made with <span style="color: #e25555;">&#9829;</span> <a href="https://naufalist.com" target="_blank" title="Naufalist">K5TEKA1</a></span>
          </div>
        </div>
      </div>
    </div>

    <div id="quiz" class="row justify-content-center" style="display: none;">
      <div class="col-9 col-sm-10 col-md-6">

        <div class="modal fade" tabindex="-1" role="dialog" id="alert">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Isi dulu lah, jangan <i>surrender</i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group row mb-1">
          <label class="col-4 col-sm-3 col-md-4 col-lg-3">
            <select class="form-control" id="netclass">
              <option value="1">A</option>
              <option value="2">B</option>
              <option value="3">C</option>
              <option value="4" selected>A/B/C</option>
            </select>
            <small class="form-text text-muted">
              Kelas Network
            </small>
          </label>
          <label class="col-8 col-sm-9 col-md-4 col-lg-3 font-weight-bold">
          <h3>
            <span id="rand_ip" class="badge badge-info" onclick="solve();">IP Address</span>
          </h3>
          </label>
        </div>

        <div class="form-group row mb-1">
          <label class="col-4 col-sm-3 col-md-4 col-lg-3 col-form-label font-weight-bold">Network</label>
          <div class="col-8 col-sm-9 col-md">
            <input id="net_add" type="text" class="form-control" placeholder="Network Address">
            <small id="net_add_ans" class="text-success"></small>
          </div>
        </div>

        <div class="form-group row mb-1">
          <label class="col-4 col-sm-3 col-md-4 col-lg-3 col-form-label font-weight-bold">First Host</label>
          <div class="col-8 col-sm-9 col-md">
            <input id="fh_add" type="text" class="form-control" placeholder="First Host Address">
            <small id="fh_add_ans" class="text-success"></small>
          </div>
        </div>

        <div class="form-group row mb-1">
          <label class="col-4 col-sm-3 col-md-4 col-lg-3 col-form-label font-weight-bold">Netmask</label>
          <div class="col-8 col-sm-9 col-md">
            <input id="mx_add" type="text" class="form-control" placeholder="Subnet Mask">
            <small id="mx_add_ans" class="text-success"></small>
          </div>
        </div>

        <div class="form-group row mb-1">
          <label  class="col-4 col-sm-3 col-md-4 col-lg-3 col-form-label font-weight-bold">Broadcast</label>
          <div class="col-8 col-sm-9 col-md">
            <input id="bc_add" type="text" class="form-control" placeholder="Broadcast Address">
            <small id="bc_add_ans" class="text-success"></small>
          </div>
        </div>

        <div class="form-group row mb-1">
          <label class="col-4 col-sm-3 col-md-4 col-lg-3 col-form-label font-weight-bold">Last Host</label>
          <div class="col-8 col-sm-9 col-md">
            <input id="lh_add" type="text" class="form-control" placeholder="Last Host Address">
            <small id="lh_add_ans" class="text-success"></small>
          </div>
        </div>

        <div class="form-group row mt-4">

          <div class="col">
            <button class="btn btn-primary btn-sm" onclick="rand_ip()">Ubah Soal</button>
          </div>
            
          <!-- <div class="col">
            <button id="check_btn" class="btn btn-success float-right btn-sm" onclick="check()">Cek Jawaban</button>
          </div> -->

          <!-- <button onclick="resetLocal()">Reset</button> -->
          
          <div class="col">
            <button id="submit_btn" class="btn btn-success float-right btn-sm" onclick="submit()">Kirim Jawaban</button>
          </div>
        </div>

      </div>
    </div>
    
    <div id="time" class="row justify-content-center mb-1" style="display: none;">
      <div class="col-9 col-sm-10 col-md-6">
        <ul class="list-group">
          <li class="list-group-item py-1">

          <!-- <div class="buttons">
            <button id="startStop" onclick="startStop()">Start</button>
            <button id="reset" onclick="reset()">Reset</button>
          </div> -->

              <label class="font-weight-bold my-0">Waktu</label>
              <p id="display" class="float-right my-0" style="display: inline">00:00:00</p>
          </li>
          <li class="list-group-item py-1">
              <label class="font-weight-bold my-0">Skor</label>
              <p id="score" class="float-right my-0" style="display: inline">0</p>
          </li>
          <li class="list-group-item py-1">
              <button class="btn btn-outline-warning btn-block btn-sm my-2" onclick="stopQuiz()">Selesai</button>
          </li>

          <!-- <form action="<?= site_url('/quiz'); ?>" method="post" id="quizform">
              <label>First Name:</label>
              <input type="hidden" name="tes">
              <button type="button" id="submitBtn">Submit Form</button>
          </form> -->

          <!-- Buat AJAX request tadinya -->
          <!-- <input type="hidden" class="csrf_token" name="<? //csrf_token() ?>" value="<? //csrf_hash() ?>" /> -->

        </ul>
      </div>
    </div>

  </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script> -->
    

    <!-- <script src="http://localhost/naufalist.com/subnet/js/jquery.js"></script>
    <script src="http://localhost/naufalist.com/subnet/js/jquery-ui.min.js"></script>
    <script src="http://localhost/naufalist.com/subnet/js/js/bootstrap.min.js"></script> -->

   
  </body>
</html>