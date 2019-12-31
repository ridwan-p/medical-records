import { Chart } from 'frappe-charts/dist/frappe-charts.esm.js'

const data = {
    labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
    datasets: [
        { values: [18, 40, 30, 35, 8, 52, 17, -4] }
    ]
}

const chart = new Chart("#chart", {  // or a DOM element,
    title: "My Awesome Chart",
    data: data,
    type: 'axis-mixed', // or 'bar', 'line', 'scatter', 'pie', 'percentage'
    height: 250,
    colors: ['#7cd6fd'],
    lineOptions: {
        dotSize: 1, // default: 4
        heatline: 1, // default: 0
        regionFill: 1,
        xIsSeries: true
    },
})