<?php

//connecting to the database
$servername = "localhost";
$username = "root";
$password ="";
$database= "testing";

//create a connection

$connection = mysqli_connect($servername, $username, $password, $database);

//die if connection was not successful
if(!$connection){
    die("Sorry, we failed to connect: " . mysqli_connect_error());
}
else{
    echo"Connection was successful <br>";
}


//craete database for diseasaes and their symptoms

//create a table for storing diseases
$sql ="CREATE TABLE `diseases`(
    diseases_id INT(100) PRIMARY KEY AUTO_INCREMENT,
    diseases_name VARCHAR(255) NOT NULL
)";

//create a table for storing symptoms
$sql = "CREATE TABLE `symptoms`(
symptoms_id INT PRIMARY KEY AUTO_INCREMENT,
symptoms_name VARCHAR(255) NOT NULL
)";

//create a table for storing treatments
$sql="CREATE TABLE `treatments`(
treatment_id INT PRIMARY KEY AUTO_INCREMENT,
treatment_name VARCHAR(255) NOT NULL,
)";

//Creata a juction table to link diseases and symptoms(Many- to-Many relationship)
$sql ="CREATE TABLE `diseases_symptoms`(
diseases_id INT,
symptoms_id INT,
PRIMARY KEY(diseases_id, symptoms_id),
FOREIGN KEY(diseases_id) REFERENCES diseases(disease_id) ON DELETE CASCADE,
FOREIGN KEY(symptoms_id) REFERENCES symptoms(symptoms_id)
)";

$sql ="CREATE TABLE `diseases_treatments`(
diseases_id INT,
treatment_id INT,
PRIMARY  KEY(diseases_id, treatment_id),
FOREIGN KEY(diseases_id) REFERENCES diseases(diseases_id) ON DELETE CASCADE,
FOREIGN KEY (treatment_id) REFERENCES treatments(treatment_id) ON DELETE CASCADE
)";

//insert data into diseases table
$sql = "INSERT INTO diseases (diseases_name) VALUES
('Common Cold'),
('Influenza (FLU)'),
('Diabetes (Type 1 and Type 2)'),
('Hypertension(High Blood Pressure)');
('Asthma'),
('Bronchitis'),
('Pneumonia'),
('Tuberculosis(TB)'),
('Gastroenteritis'),
('Urinary Tract Infection (UTI)'),
('Anemia'),
('Arthritis'),
('Allergies'),
('Migraine'),
('Skin Infection (e.g., Eczema, Dermatitis)'),
('Chickenpox'),
('Measles'),
('Hepatitis (A, B, C)'),
('Obesity'),
('Heart Diseases (e.g., Coronary Artery Diseases)')";

//insert data into symptoms table
$sql ="INSERT INTO symptoms (symptoms_name) VALUES
('Runny or stuffy nose'),
('Sore throat'),
('Sneezing'),
('Coughing'),
('Mild fever'),
('High fever'),
('Chills'),
('Body aches'),
('Fatigue'),
('Blurred vision'),
('Slow-healing wonds'),
('Headache'),
('Shortness of breath'),
('Nosebleeds'),
('Wheezing'),
('Chest tightness'),
('Persistent cough'),
('Mucus production'),
('Chest discomfort'),
('Difficulty breathing'),
('Coughing up blood'),
('Weight loss'),
('Diarrhea'),
('Abdominal cramps'),
('Nausea'),
('Vomiting'),
('Burning sensation during urination'),
('Frequent urination'),
('Cloudy or strong smelling urine'),
('Lower abdominal pain'),
('Pale skin'),
('Dizziness'),
('Cold hands and feet'),
('Joint pain'),
('Stiffness'),
('Swelling in joints'),
('Decrease range of motion'),
('Red, watery eyes'),
('Skin rashes'),
('Sensitivity to light'),
('Visual disturbances'),
('Red, inflamed skine'),
('Dry or scaly patches'),
('Blisters'),
('Ichy rash'),
('Red sports or blisters'),
('Jaundice(yellowing of skin and eyes)'),
('Dark urine'),
('Excess body fat'),
('Palpitation')";

$sql ="INSERT INTO treatments (trement_name) VALUES
('Antihistamines (e.g., loratadine)'),
('Decongestants (e.g., pseudoephedrine)',
(Acetaminophen');
('Antiviral drugs(e.g., oseltamivir, zanamivir)'),
('Insulin e.g., rapid-acting, long-acting insulin')),
('Metformin'),
('Sulfonylureas'),
('DPP-4 inhibitors'),
('SGLT2 inhibiitors'),
('ACE inhibitors(e.g.,lisinopril)'),
('Beta-blockers (e.g.,metoprolol)'),
('Inhaled corticosteroids (e.g.,fluticasone)'),
('Cough suppressants (e.g., detromethorphan)'),
('Bronchodilators'),
('Antibiotics(e.g.,azithromycin, amoxicillin)'),
('Antivirals'),
('Antifungals'),
('Isoniazid'),
('Rifampin'),
('Ethambutol'),
('Pyrazinamide'),
('Rehydration solutions'),
('Antiemetics(e.g., ondansetron)'),
('Antidiarrheals(e.g., loperamide)'),
('Nitrogurantion'),
('Ciprofloxacin'),
('Iron supplements'),
('Vitamin B12 injections'),
('Folic acid'),
('NSAIDS(e.g., ibuprofen, naproxen)'),
('Corticosteroids'),
('DMARDS (e.g., methotrexate)'),
('Cetirine'),
('Triptans (e.g., sumatriptan)'),
('Preventive medication (e.g., propranolol, topiramate)'),
('Hydrocortisone'),
('Mupirocin'),
('Acyclovir'),
('Diphenhydramine'),
('Vitamin A'),
('Sofosbuvir for Hepatitis C'),
('Interferon therapy'),
('Phentermine'),
('Liraglutide'),
('Statins (e.g., atorvastation)'),
('Carvedilol'),
('Enalapril')";

//insert data into diseases_symptoms table
$sql ="INSERT INTO diseases_symptoms (diseases_id, symptoms_id) VALUES 

--common cold
(1,1), (1,2), (1,3), (1,4), (1,5),

--Influenza(flu)
(2,6), (2,7), (2,8), (2,9), (2,4), (2,2),

--Diabetes(Type 1 and Type2)
(3,6), (3,7), (3,8), (3,9), (3,4), (3,3),

--Hypertension(High Blood pressure)
(4,12), (4,13), (4,14),

--Asthma
(5,15), (5,13),(5,16), (5,4),

--Bronchitis
(6,17), (6,18), (6,19), (6,9), (6,5),

--Pneumonia
(7,6), (7,18), (7,19), (7,20), (7,9),

--Tuberculosis(TB)
(8,17), (8,19), (8,22), (8,6), (8,21),

--Gastroenteritis
(9,23), (9,24), (9,25), (9,26), (9,6),

--Urinary tract infection(UTI)
(10,27), (10,28), (10,29), (10,30),

--Anemia
(11,9), (11,31), (11,13), (11,32), (11,33),

--Arthritis
(12,34), (12,35), (12,36), (12,37),

--Allergies
(13,3), (13,1), (13,38), (13,39),

--Migraine
(14,12), (14,25), (14,40), (14,41),

--Skin Infection(eg.Eczema,Dermatitis)
(15,42), (15,43), (15,44), (15,45),

--chickenpox
(16,45), (16,46), (16,6), (16,9),

--Measles
(17,6), (17,4), (17,46), (17,38), (17,39), (17,1),

--Hepatitis(A, B, C)
(18,9), (18,47), (18,24), (18,25), (18,48),

--Obesity
(19,49), (19,13), (19,9), (19,34),

--Heart Diseases
(20,19), (20,13), (20,9), (20,50), (20,32)";


//insert data into diseases_treatments table

$sql ="INSERT INTO diseases_treatments(diseases_id, treatment_id) VALUES
--common cold
(1,1), (1,2), (1,3), 

--Influenza(flu)
(2,4), (2,3),

--diabetes (type 1 and type 2)
(3,5), (3,6), (3,7), (3,8), (3,9),

--Hypertension(High blood pressure)
(4,10), (4,11),

--Asthma
(5,12),

--Bronchitis
(6,13), (6,14), (6,15),

--Pneumonia
(7,15), (7,16), (7,17),

--Tuberculosis
(8,18), (8,19), (8,20), (8,21),

--Gastroenteritis
(9,22), (9,23), (9,24),

--Urinary Tract Infectiob
(10,25), (10,26),

--Anemia
(11,27), (11,28), (11,29),

--Arthritis
(12,30), (12,31), (12,32),

--Allergies
(13,1), (13,12), (13,33),

--Migraine
(14,34), (14,30), (14,35),

--Skin infection
(15,36), (15,37),

--Chicken pox
(16,38), (16,39),

--Measles
(17,40),

--Hepatitis (A, B, C)
(18,41), (18,42),

--Obesity 
(19,43), (19,44),

--Heart Diseases
(20,45), (20,46), (20,47)";
?>