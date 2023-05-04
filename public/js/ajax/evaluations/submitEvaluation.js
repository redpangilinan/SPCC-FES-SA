$("#evaluation_form").submit(function (e) {
    e.preventDefault();
    let evalComment = $("#comment").val();
    submitDisable();
    $.ajax({
        url: "../../src/crud/reports/create.php",
        method: "POST",
        data: {
            evalEvaluationId: evalEvaluationId,
            evalComment: evalComment,
            evalRating: calculateAverages(getEvaluationData()).totalWeightedAverage,
            evaluationData: getEvaluationData(),
        },
        success: function (data) {
            if (data == "success") {
                customAlert("success", "Evaluation submitted!", "You have successfully submitted your evaluation.", true);
            } else if (data == "already_evaluated") {
                customAlert("error", "You have already evaluated!", "You have already submitted an evaluation!");
            } else {
                console.log(data)
                customAlert("error", "Something went wrong!", "Something went wrong! Please try again later.");
            }
        }
    });
});

const getEvaluationData = () => {
    // Get all the tables
    let tables = document.querySelectorAll('table:not(:first-child)');

    // Loop through the tables and extract the data
    let data = [];
    for (let i = 0; i < tables.length; i++) {
        let table = tables[i];
        let weight = table.dataset.weight;
        let category = table.dataset.category;
        let rows = table.querySelectorAll('tbody tr');
        for (let j = 0; j < rows.length; j++) {
            let row = rows[j];
            let question = row.querySelector('td:first-child').textContent;
            let answer = row.querySelector('input:checked');
            let answerValue = answer ? answer.value : "";
            let obj = { category: category, question: question, answer: answerValue, weight: weight };
            data.push(obj);
        }
    }

    // Convert the data to JSON and log it
    let jsonData = JSON.stringify(data);
    return jsonData;
}

const calculateAverages = (jsonData) => {
    // Parse the JSON data
    let data = JSON.parse(jsonData);

    // Calculate the average score per category
    let categories = {};
    data.forEach((item) => {
        if (!categories[item.category]) {
            categories[item.category] = { totalWeightedScore: 0, totalWeight: 0 };
        }
        let weight = parseFloat(item.weight);
        let score = parseFloat(item.answer);
        categories[item.category].totalWeightedScore += weight * score;
        categories[item.category].totalWeight += weight;
    });
    let categoryAverages = {};
    for (let category in categories) {
        categoryAverages[category] = categories[category].totalWeightedScore / categories[category].totalWeight;
    }

    // Calculate the total weighted average
    let totalWeightedScore = 0;
    let totalWeight = 0;
    data.forEach((item) => {
        let weight = parseFloat(item.weight);
        let score = parseFloat(item.answer);
        totalWeightedScore += weight * score;
        totalWeight += weight;
    });
    let totalWeightedAverage = totalWeightedScore / totalWeight;

    // Return the results as an object
    return { categoryAverages: categoryAverages, totalWeightedAverage: totalWeightedAverage };
}

// Button modification
const submitDisable = () => {
    document.querySelector("#submit_evaluation").innerHTML = "Submitting...";
    document.querySelector("#submit_evaluation").disabled = true;
}