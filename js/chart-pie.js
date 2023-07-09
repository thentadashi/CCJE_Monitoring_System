new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
      labels: ["Trainee", "Team Leader", "Municipality"],
      datasets: [{
        label: "Chart Pie",
        backgroundColor: ["#3e95cd", "#8e5ea2","#c45850"],
        data: [2,1,3]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Chart Pie'
      }
    }
});