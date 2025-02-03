document.addEventListener("DOMContentLoaded", function() {
  const chartData = {
      labels: ["Debit", "Credit"],
      data: [json_encode($total_sum_debit_this_month), json_encode($total_sum_credit_this_month)],
  };
  const chartData2 = {
      labels: ["Debit", "Credit"],
      data: [json_encode($total_sum_debit_last_month), json_encode($total_sum_credit_last_month)],
  };

  const myChart = document.querySelector(".my-chart");
  const myChart2 = document.querySelector(".my-chart2");
  const ul = document.querySelector(".details ul");
  const ul2 = document.querySelector(".details2 ul");
  const balanceUl = document.querySelector(".details2 .balance");
  const balanceUl1 = document.querySelector(".details .balance");

  if (myChart) {
      new Chart(myChart, {
          type: "doughnut",
          data: {
            labels: chartData.labels,
              datasets: [
                  {
                      label: "Financial Data",
                      data: chartData.data,
                      backgroundColor: ["#1f3864", "#00b0f0"]
                  },
              ],
          },
          options: {
              plugins: {
                  legend: {
                      display: true,
                  },
              },
          },
      });
  }

  if (myChart2) {
      new Chart(myChart2, {
          type: "doughnut",
          data: {
            labels: chartData2.labels,
              datasets: [
                  {
                      label: "Financial Data",
                      data: chartData2.data,
                      backgroundColor: ["#1f3864", "#00b0f0"]
                  },
              ],
          },
          options: {
              plugins: {
                  legend: {
                      display: true,
                  },
              },
          },
      });
  }

  const populateUl = (data, labels, ulElement) => {
      if (ulElement) {
          ulElement.innerHTML = "";
          labels.forEach((label, i) => {
              let li = document.createElement("li");
              let value = data[i];
              let color = value < 0 ? "red" : "black";
              li.innerHTML = `${label}: <span class='money' style='color: ${color};'><?= $_SESSION['LoggedInUser']['Currency']?> ${value}</span>`;
              ulElement.appendChild(li);
          });
      }
  };



  populateUl(chartData.data, chartData.labels, ul);
  populateUl(chartData2.data, chartData2.labels, ul2);
  showBalance(chartData.data);
  showBalance(chartData2.data);
});