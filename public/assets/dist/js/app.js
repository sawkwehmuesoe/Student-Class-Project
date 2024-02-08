

$(document).ready(function(){

    // Start Left Side Bar

    $(".sidebarlinks").click(function(){
        $(".sidebarlinks").removeClass("currents");
        $(this).addClass("currents");
    });

    // End Left Side Bar

});

// Start Js Area 

/* Start Top Side Bar  */

/* Start notify & userlogout  */

// Start Dropdown 

function dropbtn(e){
    // console.log(e.target);

    e.target.parentElement.nextElementSibling.classList.toggle("show");
}

// End Dropdown 

/* End Top Side Bar  */

// Start Expend Area

  const ctx = document.getElementById('mypiechart');
    ctx.height = 250;
  new Chart(ctx, {
    type: 'doughnut',
    data: {

      datasets: [{

        data: [12, 19, 3],
      }]
    },
    options: {
        responsive: false
    }
  });



// End Expend Area

/* End notify & userlogout  */

// Start Earning Area

google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          title: 'Sales Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }

// End Earning Area

// End Js Area 

// let result = Math.min(10,20,5,6,8,2,60,18,7);
// console.log(result); 2
// let results = Math.max(10,20,5,6,8,2,60,18,7);
// console.log(results); 60

// Get Minimum Number 
// var arrnums = [5,10,15,3,7,8,20,6];

// function getminnumber(numbers){

//   let minnumber = numbers[0];

//   for(var x =0; x < numbers.length ; x++){
//     // Get mini number 
//     if(numbers[x] < minnumber){
//       minnumber = numbers[x];
//     }

//     // if(numbers[x] > minnumber){
//     //   minnumber = numbers[x];
//     // }
//   }

//   return minnumber;
// }

// console.log(getminnumber(arrnums));

// --------------------------------------

// var arrnumstwo = [5,10,15,3,7,8,20,6];

// function sortmantominnum(numbers,curidx){

//   for(let y = 0; y < numbers.length; y++){

//     let maxnumber = numbers[y];
//     let curidx = y;



//   }


  // let maxnumber = numbers[0];
  // let curidx;

//   for(let x =y; y < numbers.length;y++){

//     // GEt Max Number 
//     if(numbers[x] > maxnumber){
//       maxnumber = numbers[x];
//       curidx = x;
//     }

//   }

//   // return [maxnumber,curidx];

//   // swap idx 6 to idx 0 
//   // numbers[curidx] = numbers[0];
//   // // return [maxnumber,curidx,numbers];
//   // numbers[0] = maxnumber;
//   //  return [maxnumber,curidx,numbers];

//     numbers[curidx] = numbers[y];
//     numbers[y] = maxnumber;

//     return numbers;

// }

// console.log(sortmantominnum(arrnumstwo));

// ----------------------------------------------------

// 21 6 2023 

// var arrnums = [5,10,15,3,7,8,20,6];

// function getminnumber(number){
//   var minnumber = number[0];

//   for(var x = 0; x < number.length ; x++){

//     // if(number[x] < minnumber){
//     //   minnumber = number[x];
//     // }

//     if(number[x] > minnumber){
//       minnumber = number[x];
//     }

//   }

//   return minnumber;
// }

// console.log(getminnumber(arrnums));

// ---------------------------------------------

// var arrnumstwo = [5,10,15,3,7,8,20,6];

// function sortmaxtominnum(numbers){

//   for(let y =0; y <numbers.length ; y++){

//     var maxnumber = numbers[y];
//     var curidx = y;

//     // var maxnumber = numbers[0];
//     // var curidx;
  
//     for(var x=y ;x < numbers.length;x++){

//       // Get Max Number
//       // if(numbers[x] > maxnumber){
//       //   maxnumber = numbers[x];
//       //   curidx = x;
//       // }

//        // Get Max Number
//       if(numbers[x] > maxnumber){
//         maxnumber = numbers[x];
//         curidx = x;
//       }

//       // Get Min Number 
//       // if(numbers[x] < maxnumber){
//       //   maxnumber = numbers[x];
//       //   curidx = x;
//       // }
//     }
  
//     // numbers[curidx] = numbers[0];
  
//     // return [maxnumber,curidx,numbers];
//     // numbers[0] = maxnumber;
//     //  return [maxnumber,curidx,numbers];

//     numbers[curidx] = numbers[y];
//     numbers[y] = maxnumber;

    
//   }

//   return numbers;

// }

// console.log(sortmaxtominnum(arrnumstwo));


// ----------------------------------------------

let saledatas = [

  {
    title:"Order Value",
    rank:80,
    value:"120.8%",
    color:"bg-secondary"
  },

  {
    title:"Total Product",
    rank:50,
    value:"325.2%",
    color:"bg-success"
  },

  {
    title:"Quantity",
    rank:70,
    value:"25.60%",
    color:"bg-warning"
  },

  {
    title:"New SKU",
    rank:43,
    value:"13.34%",
    color:"bg-info"
  },

  {
    title:"Dept",
    rank:10,
    value:"3.40%",
    color:"bg-danger"
  },

];




function sortmaxtominnum(saledatas){

  for(let y =0; y <saledatas.length ; y++){

    var maxnumber = saledatas[y];
    var curidx = y;

    for(var x=y ;x < saledatas.length;x++){

    
       // Get Max Number
      if(saledatas[x].rank > maxnumber.rank){
        maxnumber = saledatas[x];
        curidx = x;
      }

     
    }
  
  

    saledatas[curidx] = saledatas[y];
    saledatas[y] = maxnumber;

    
  }

  return saledatas;

}




function showsaledatas(sortdata){

  let getsalecontainer = document.getElementById('sales-container');

  let progress =`<div>`;

  for(let x = 0; x < sortdata.length ; x++){
    progress += `
    <div class="mt-2">
      <div class="d-flex justify-content-between">
        <small>${sortdata[x].title}</small>
        <small>${sortdata[x].value}</small>
      </div>
      <div class="progress">
        <div class="progress-bar ${sortdata[x].color}" style="width: ${sortdata[x].rank}%;" aria-valuenow="${sortdata[x].rank}" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
    </div>
    `
  }

  progress += `</div>`;

  // 

  getsalecontainer.innerHTML = progress;

}

window.onload = function(){
  let sortdata = sortmaxtominnum(saledatas);
  showsaledatas(sortdata);
}

