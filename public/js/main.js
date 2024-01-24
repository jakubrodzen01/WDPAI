function updateExerciseDay() {
    // Pobierz wybraną datę z pola daty
    var selectedDate = document.getElementById("datepicker").value;

    // Zaktualizuj etykietę exercise_day
    var exerciseDayLabel = document.querySelector(".exercise_day");
    exerciseDayLabel.textContent = selectedDate;
}