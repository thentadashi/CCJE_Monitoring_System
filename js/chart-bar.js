
new Chart(document.getElementById("bar-charta"), {
    type: 'bar',
    data: {
      labels: ["Data Sheet", "Parent Consent", "PhilHealth ID", "Vaccine Card", "Pregnancy Test"],
      datasets: [
        {
          label: "Requirements Submitted (count*)",
          backgroundColor: ["#c45850","#c45850","#c45850","#c45850","#c45850"],
          data: [490, 50, 25 ]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Requirements Submitted (count*)'
      }
    }
});