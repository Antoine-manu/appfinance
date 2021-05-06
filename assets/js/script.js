var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

var totalinc = document.getElementById('totalinc').dataset.number;
var totalexp = document.getElementById('totalexp').dataset.number;



let ctx = document.getElementById('myChart').getContext('2d');
let labels = ['Dépenses', 'Rentrés'];
let colorHex = ['#FF5733', '#42CA1D'];

let myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    datasets: [{
      data: [totalexp, totalinc],
      backgroundColor: colorHex
    }],
    labels: labels
  },
  options: {
    responsive: true,
    legend: {
      position: 'bottom'
    },
    plugins: {
      datalabels: {
        color: '#262626',
        anchor: 'end',
        align: 'start',
        offset: -10,
        borderWidth: 2,
        borderColor: '#262626',
        borderRadius: 25,
        backgroundColor: (context) => {
          return context.datasets.backgroundColor;
        },
        font: {
          weight: 'bold',
          size: '10'
        },
        formatter: (value) =>{
          return value + '%';
        }
      }
    }
  }
})