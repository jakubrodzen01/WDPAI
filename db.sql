-- Tworzenie tabel
CREATE TABLE IF NOT EXISTS records (
    id SERIAL PRIMARY KEY,
    exercise_id INTEGER REFERENCES exercise(id),
    max_weight INTEGER,
    max_repetitions INTEGER
);

CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    email VARCHAR(255) UNIQUE,
    password VARCHAR,
    name VARCHAR,
    surname VARCHAR
);

CREATE TABLE IF NOT EXISTS plans (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES users(id),
    plan_name VARCHAR,
    date VARCHAR
);

CREATE TABLE IF NOT EXISTS exercise (
    id SERIAL PRIMARY KEY,
    plan_id INTEGER REFERENCES plans(id),
    exercise_name VARCHAR,
    sets INTEGER,
    reps INTEGER,
    weight INTEGER
);

-- Tworzenie triggera
CREATE OR REPLACE FUNCTION update_max_values()
RETURNS TRIGGER AS $$
BEGIN
    UPDATE records
    SET max_weight = NEW.weight,
        max_repetitions = NEW.reps
    WHERE exercise_id = NEW.id;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER update_max_values_trigger
AFTER INSERT ON exercise
FOR EACH ROW
EXECUTE FUNCTION update_max_values();

-- Tworzenie transakcji
BEGIN;
SAVEPOINT start_transaction;

-- Dodawanie danych
INSERT INTO users (email, password, name, surname) VALUES ('example@email.com', 'password', 'John', 'Doe');
INSERT INTO plans (user_id, plan_name, date) VALUES (1, 'Workout Plan', '2024-01-01');
INSERT INTO exercise (plan_id, exercise_name, sets, reps, weight) VALUES (1, 'Squats', 3, 10, 100);

-- Zakończenie transakcji
COMMIT;

-- Tworzenie widoków
CREATE OR REPLACE VIEW user_exercise_view AS
SELECT u.name || ' ' || u.surname AS user_name, e.exercise_name, e.sets, e.reps, e.weight
FROM users u
JOIN plans p ON u.id = p.user_id
JOIN exercise e ON p.id = e.plan_id;

CREATE OR REPLACE VIEW max_values_view AS
SELECT r.id AS record_id, e.exercise_name, r.max_weight, r.max_repetitions
FROM records r
JOIN exercise e ON r.exercise_id = e.id;
