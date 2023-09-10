function getRandomColor() {
  const randomBetween = (min, max) =>
    min + Math.floor(Math.random() * (max - min + 1));
  const r = randomBetween(0, 255);
  const g = randomBetween(0, 255);
  const b = randomBetween(0, 255);
  const rgb = `rgb(${r},${g},${b})`;
  return rgb;
}

function prepareDataForPlot(xValues, uniqueYvalues, dbResults, columnName) {
  var counter = 0;
  let results=dbResults;
  for (var i = 0; i < xValues.length; i++) {
    for (var j = 0; j < uniqueYvalues.length; j++) {
      for (var k = 0; k < dbResults.length; k++) {
        if (
          uniqueYvalues[j] == dbResults[k][columnName] &&
          xValues[i] == dbResults[k].date
        ) {
          counter = counter + 1;
        } else continue;
      }
      if (counter == 0) {
        results.push({
          date: xValues[i],
          [columnName]: uniqueYvalues[j],
          total: 0,
        });
      }
      counter = 0;
    }
  }

  results.sort(function (a, b) {
    return new Date(a.date) - new Date(b.date);
  });
  let preparedData = [];
  for (var j = 0; j < uniqueYvalues.length; j++) {
    var filteredRoleData = results.filter(function (el) {
      return el[columnName] == uniqueYvalues[j];
    });
    preparedData.push({
      label: uniqueYvalues[j],
      borderColor: getRandomColor(),
      data: filteredRoleData.map((a) => a.total),
      fill: true,
    });
  }
  return preparedData;
}
