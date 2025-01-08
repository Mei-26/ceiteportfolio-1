<?php
session_start();

class DatabaseHandler {

    private $pdo;

    public function __construct() {
        // Set your database connection parameters here
        $dbHost = 'localhost';
        $dbPort = '3306';
        $dbName = 'eportfolio';
        $dbUser = 'root';
        $dbPassword = '';


        try {
            $dsn = "mysql:host=$dbHost;port=$dbPort;dbname=$dbName";
            $this->pdo = new PDO($dsn, $dbUser, $dbPassword);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Handle connection errors
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getAllRowsFromTable($tableName) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM $tableName WHERE status = 0");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function getSubject_SectionYearSemLevel($semester,$schoolyear) {
        try {
            $stmt = $this->pdo->prepare("SELECT a.*,d.yearlevel,d.semester,d.schoolyear FROM `subject` as a 
            JOIN course as b 
            ON a.course_id = b.id
            JOIN department_details as c 
            ON b.department_id = c.id
            JOIN deparment_section as d 
            ON c.id = d.department_id
            WHERE a.status = 0 AND b.status = 0 AND c.status = 0 AND d.status = 0
                AND d.semester = :semester
                AND d.schoolyear = :schoolyear
            GROUP BY a.id
                ");

            $stmt->bindParam(':semester', $semester, PDO::PARAM_INT);
            $stmt->bindParam(':schoolyear', $schoolyear, PDO::PARAM_INT);
            
            $stmt->execute();
    

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function getSections() {
        try {
            $stmt = $this->pdo->prepare("SELECT a.*,d.yearlevel,d.semester,d.schoolyear,c.depatment_college FROM `subject` as a 
            JOIN course as b 
            ON a.course_id = b.id
            JOIN department_details as c 
            ON b.department_id = c.id
            JOIN deparment_section as d 
            ON c.id = d.department_id
            WHERE a.status = 0 AND b.status = 0 AND c.status = 0 AND d.status = 0
            GROUP BY a.id
                ");

            
            $stmt->execute();
    

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }
    public function getSectionsWhereCollge($college_id,$semester,$academicYear) {
        try {
            $stmt = $this->pdo->prepare("SELECT b.*
                FROM `faculty_subject_section` as a 
                JOIN subject as b 
                ON a.subject_id = b.id
                JOIN course as c 
                ON b.course_id = c.id
                WHERE c.college_id = '$college_id' AND
                a.sem = '$semester' AND a.sy = '$academicYear'
                Group By b.id
                ");

            $stmt->execute();
    

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }
    public function getSectionsWhereCollgeFaculty($college_id,$semester,$academicYear,$faculty_id) {
        try {
            $stmt = $this->pdo->prepare("SELECT b.* FROM `faculty_subject_section` as a 
                JOIN subject as b 
                ON a.subject_id = b.id
                JOIN course as c 
                ON b.course_id = c.id
                WHERE c.college_id = '$college_id' AND
                a.sem = '$semester' AND a.sy = '$academicYear' AND faculty_id = '$faculty_id'
                Group By b.id
                ");

            $stmt->execute();
    

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }
    public function getSectionsWhereCollge2($college_id,$semester,$academicYear,$department_id) {
        try {
            $stmt = $this->pdo->prepare("SELECT b.* FROM `faculty_subject_section` as a 
                JOIN subject as b 
                ON a.subject_id = b.id
                JOIN course as c 
                ON b.course_id = c.id
                WHERE c.college_id = '$college_id' AND
                a.sem = '$semester' AND a.sy = '$academicYear'
                AND c.id = '$department_id'
                Group By b.id
                ");

            $stmt->execute();
    

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function getUsers($role) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT a.added,b.* FROM `users` as a 
                JOIN user_details as b 
                ON a.id = b.user_id
                WHERE a.status = 0 AND a.role = :role
            ");
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function getCollegeOfficers() {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM college_officers
            ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function getAllFaculties() {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM `users` as a 
                JOIN user_details as b 
                ON a.id = b.user_id
                WHERE a.status = 0 
            ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function getAllFaculties3() {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM `users` as a 
                JOIN user_details as b 
                ON a.id = b.user_id
                WHERE a.status = 0 
            ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function getAllFaculties2() {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM `users` as a 
                JOIN user_details as b 
                ON a.id = b.user_id
                WHERE a.status = 0 
                AND a.role ='faculty'
            ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function getAllFacultiesForSecretary($deparment_id="") {
        try {
            if($deparment_id=="")
            {
                return array();
            }else{
                $stmt = $this->pdo->prepare("
                SELECT * FROM `users` as a 
                JOIN user_details as b 
                ON a.id = b.user_id
                WHERE a.status = 0 
                AND a.role  !='college_dean' 
                AND a.role !='college_secretary'
            ");
            }
            
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }
    

    public function getAllSections($deparment_id) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM `deparment_section` WHERE `department_id` = :deparment_id AND status = 0 ORDER BY yearlevel ASC
            ");
            $stmt->bindParam(':deparment_id', $deparment_id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function getAllSectionsByCollegeID($depatment_college) {
        try {
            $stmt = $this->pdo->prepare("
             SELECT a.*,b.depatment_college FROM `deparment_section` as a 
            JOIN department_details as b 
            ON a.department_id = b.id
            WHERE `depatment_college` = :depatment_college AND a.status = 0
            AND b.status = 0
            ");
            $stmt->bindParam(':depatment_college', $depatment_college, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function getAllCalendar($faculty_id,$type) {
        try {
            $stmt = $this->pdo->prepare("
            SELECT * FROM `calendar`
            WHERE `type` = :type AND `user_id` = :faculty_id
            ");
            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            $stmt->bindParam(':faculty_id', $faculty_id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function getSectionForDocuments($subject_id,$faculty_id) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM faculty_subject_section as a 
                JOIN deparment_section as b 
                ON a.section_id = b.id
                WHERE 
                a.status = 0 
                AND b.status = 0
                AND b.status = 0
                AND a.subject_id = :subject_id AND a.faculty_id = :faculty_id
            ");
            $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_STR);
            $stmt->bindParam(':faculty_id', $faculty_id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function getAllRoom() {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM room
                WHERE status = 0 
            ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }
    public function getAllCourse() {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM course
                WHERE status = 0 
            ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }
    public function getAllCourseByDepartment($deparment_id) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM course
                WHERE status = 0 AND department_id = '$deparment_id'
            ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }
    public function getAllSubjects($department_id) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT a.* FROM `subject` as a 
                JOIN course as b 
                ON a.course_id = b.id
                WHERE a.status = 0 AND b.status = 0 AND b.department_id = :department_id
            ");
            $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log the error to a file or monitoring system
            error_log("Query failed: " . $e->getMessage());
    
            // Optionally, throw the exception again or return false/null
            throw new Exception("Unable to fetch subjects. Please try again later.");
        }
    }

    public function getAllSectionsByDepartment($department_id) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM `deparment_section` WHERE `department_id` = :department_id AND status = 0
            ");
            $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log the error to a file or monitoring system
            error_log("Query failed: " . $e->getMessage());
    
            // Optionally, throw the exception again or return false/null
            throw new Exception("Unable to fetch subjects. Please try again later.");
        }
    }

    public function getAllSubjectsbyDepartment($deparment_id) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT a.* FROM `subject` as a 
                JOIN course as b 
                ON a.course_id = b.id
                WHERE b.department_id = :deparment_id AND a.status = 0 AND b.status = 0
            ");
            $stmt->bindParam(':deparment_id', $deparment_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log the error to a file or monitoring system
            error_log("Query failed: " . $e->getMessage());
    
            // Optionally, throw the exception again or return false/null
            throw new Exception("Unable to fetch subjects. Please try again later.");
        }
    }

    public function getAllSubjectsbyCollege($college_id) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT a.* FROM `subject` as a 
                JOIN course as b 
                ON a.course_id = b.id
                WHERE b.college_id = :college_id AND a.status = 0 AND b.status = 0
            ");
            $stmt->bindParam(':college_id', $college_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log the error to a file or monitoring system
            error_log("Query failed: " . $e->getMessage());
    
            // Optionally, throw the exception again or return false/null
            throw new Exception("Unable to fetch subjects. Please try again later.");
        }
    }
    public function getAllFacultySectionsBySubjectID($subject_id) {
        try {
            $stmt = $this->pdo->prepare("
                   SELECT b.*,a.faculty_id,a.section_id,a.sem,a.sy FROM `faculty_subject_section` as a 
                    JOIN deparment_section as b 
                    ON a.section_id = b.id
                    WHERE a.status = 0 AND b.status = 0 AND a.subject_id = :subject_id
            ");
            $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log the error to a file or monitoring system
            error_log("Query failed: " . $e->getMessage());
    
            // Optionally, throw the exception again or return false/null
            throw new Exception("Unable to fetch subjects. Please try again later.");
        }
    }

    public function getSemAndSchoolyears($college_id) {
        try {
            $stmt = $this->pdo->prepare("
                   SELECT current_sem, current_year,current_status  
                    FROM `current_year_sem` WHERE college_id = :college_id
                    GROUP BY current_year,current_sem,current_status,current_status
                    ;
            ");
            $stmt->bindParam(':college_id', $college_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log the error to a file or monitoring system
            error_log("Query failed: " . $e->getMessage());
    
            // Optionally, throw the exception again or return false/null
            throw new Exception("Unable to fetch subjects. Please try again later.");
        }
    }
  

    public function getAllRowsFromTableWhere($tableName, array $additionalConditions = []) {
        try {
            // Construct the WHERE clause with status = 0 and additional conditions
            $whereClause = "status = 0";
    
            if (!empty($additionalConditions)) {
                $whereClause .= " AND " . implode(' AND ', $additionalConditions);
            }
    
            // Prepare the SQL statement with the dynamic WHERE clause
            $sql = "SELECT * FROM $tableName WHERE $whereClause";
            $stmt = $this->pdo->prepare($sql);
    
            // Execute the query
            $stmt->execute();
    
            // Fetch the results as an associative array
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function getSubjectsByDepartments($department_id) {
        try {
            // Prepare the SQL statement with a placeholder for department_id
            $sql = "SELECT a.* FROM `subject` AS a 
                    JOIN course AS b ON a.course_id = b.id
                    WHERE b.department_id = :department_id";
            $stmt = $this->pdo->prepare($sql);
            
            // Bind the department_id parameter
            $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
            
            // Execute the query
            $stmt->execute();
            
            // Fetch the results as an associative array
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function getFacultyUploads($faculty_id,$section_id,$semester,$year) {
        try {
            // Prepare the SQL statement with a placeholder for department_id
            $sql = " SELECT * FROM `for_uploads` as a 
            JOIN faculty_uploads as b 
            ON a.id = b.upload_id
            WHERE 
            b.faculty_id = '$faculty_id' 
            AND b.section_id = '$section_id'
            AND b.semester = '$semester'
            AND b.year = '$year' ";
            $stmt = $this->pdo->prepare($sql);
            
            // Bind the department_id parameter
            
            // Execute the query
            $stmt->execute();
            
            // Fetch the results as an associative array
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }

  
    public function getfaculty_subject_section_by_department($department_id, $subject_id,$sy,$sem) {
        try {
            // Prepare the SQL statement with placeholders for department_id and subject_id
            $sql = "SELECT a.* 
                    FROM faculty_subject_section AS a
                    JOIN subject AS b ON a.subject_id = b.id
                    JOIN course AS c ON b.course_id = c.id
                    WHERE c.department_id = :department_id 
                    AND a.subject_id = :subject_id
                    AND a.sy = :sy
                    AND a.sem = :sem
                    ";
    
            // Prepare the statement
            $stmt = $this->pdo->prepare($sql);
    
            // Bind parameters
            $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
            $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
            $stmt->bindParam(':sy', $sy);
            $stmt->bindParam(':sem', $sem);
            // Execute the query and fetch results
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
    
        } catch (PDOException $e) {
            // Log the error message for debugging purposes (consider replacing echo with logging)
            error_log("Query failed: " . $e->getMessage());
            return []; // Return an empty array in case of failure
        }
    }
    
    
    public function getAllRowsFromTableWhereGroup($tableName, array $additionalConditions = [], $groupBy = null) {
        try {
            // Construct the WHERE clause with status = 0 and additional conditions
            $whereClause = "status = 0";
    
            if (!empty($additionalConditions)) {
                $whereClause .= " AND " . implode(' AND ', $additionalConditions);
            }
    
            // Construct the GROUP BY clause if $groupBy is provided
            $groupByClause = "";
            if (!empty($groupBy)) {
                $groupByClause = " GROUP BY " . $groupBy;
            }
    
            // Prepare the SQL statement with the dynamic WHERE and GROUP BY clauses
            $sql = "SELECT * FROM $tableName WHERE $whereClause $groupByClause";
            $stmt = $this->pdo->prepare($sql);
    
            // Execute the query
            $stmt->execute();
    
            // Fetch the results as an associative array
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        } catch (PDOException $e) {
            // Handle query errors
            echo "Query failed: " . $e->getMessage();
        }
    }
    
    
    public function loginUser($employment_id, $password) {
        try {
            // Sanitize and validate input
            $employment_id = trim($employment_id); // Trim whitespace
            // htmlentities is not needed here because parameter binding takes care of SQL injection risks
    
            // Prepare the SQL statement
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE employment_id = :employment_id AND status = 0");
            $stmt->bindParam(':employment_id', $employment_id, PDO::PARAM_STR);
            $stmt->execute();
    
            // Fetch the user
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user) {
                // // Use password_verify to check the hashed password
                if (password_verify($password, $user['password'])) {
                    // Set session variables securely
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['id'] = $user['id'];
                    // Regenerate session ID to prevent session fixation
                    session_regenerate_id(true);
    
                    return true; // Login successful
                }
            }
    
            return false; // Login failed
    
        } catch (PDOException $e) {
            // Log the error message internally
            error_log("Login query failed: " . $e->getMessage());
    
            // Return a generic error message
            return false;
        }
    }
    
    

    
    public function insertData($tableName, $data) {
        try {
            foreach ($data as $key => $value) {
                $data[$key] = trim(htmlentities($value));
            }

            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            
            $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
            $stmt = $this->pdo->prepare($sql);
            
            foreach ($data as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
            
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getLastInsertId() {
        return $this->pdo->lastInsertId();
    }

    public function updateData($tableName, $data, $whereConditions) {
        try {
            $setClause = '';
            foreach ($data as $key => $value) {
                $setClause .= "$key = :$key, ";
            }
            // Remove the trailing comma and space from the setClause
            $setClause = rtrim($setClause, ', ');
    
            $whereClause = '';
            foreach ($whereConditions as $whereKey => $whereValue) {
                $whereClause .= "$whereKey = :where_$whereKey AND ";
            }
            // Remove the trailing "AND" from the whereClause
            $whereClause = rtrim($whereClause, ' AND ');
    
            $sql = "UPDATE $tableName SET $setClause WHERE $whereClause";
            $stmt = $this->pdo->prepare($sql);
    
            foreach ($data as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
    
            foreach ($whereConditions as $whereKey => $whereValue) {
                $stmt->bindValue(':where_' . $whereKey, $whereValue);
            }
    
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
            // You can log or handle the error here.
        }
    }
    
    
    public function hardDelete($faculty_id,$sy,$sem) {
        try {
            // Prepare the SQL statement with placeholders
            $sql = "DELETE FROM faculty_subject WHERE `faculty_id` = :faculty_id AND sy = :sy AND sem = :sem";
            $stmt = $this->pdo->prepare($sql);
    
            // Bind parameters to the placeholders
            $stmt->bindParam(':faculty_id', $faculty_id, PDO::PARAM_INT);
            $stmt->bindParam(':sy', $sy, PDO::PARAM_STR);
            $stmt->bindParam(':sem', $sem, PDO::PARAM_STR);
            // Execute the statement
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log it or display an error message)
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function hardDeleteFacultyList($faculty_id,$department_id) {
        try {
            // Prepare the SQL statement with placeholders
            $sql = "DELETE FROM department_faculty WHERE `faculty_id` = :faculty_id AND department_id = :department_id ";
            $stmt = $this->pdo->prepare($sql);
    
            // Bind parameters to the placeholders
            $stmt->bindParam(':faculty_id', $faculty_id, PDO::PARAM_INT);
            $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
            // Execute the statement
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log it or display an error message)
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function hardDeleteCredential($credential_id,$user_id) {
        try {
            // Prepare the SQL statement with placeholders
            $sql = "DELETE FROM credential_added WHERE `id` = :credential_id AND user_id = :user_id";
            $stmt = $this->pdo->prepare($sql);
    
            // Bind parameters to the placeholders
            $stmt->bindParam(':credential_id', $credential_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
            // Execute the statement
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log it or display an error message)
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function hardDeleteFacultySubject($faculty_id,$subject_id,$sy,$sem) {
        try {
            // Prepare the SQL statement with placeholders
            $sql = "DELETE FROM faculty_subject_section 
            WHERE `faculty_id` = :faculty_id AND subject_id = :subject_id AND sy = :sy AND sem = :sem";
            $stmt = $this->pdo->prepare($sql);
    
            // Bind parameters to the placeholders
            $stmt->bindParam(':faculty_id', $faculty_id, PDO::PARAM_INT);
            $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
            $stmt->bindParam(':sy', $sy, PDO::PARAM_STR);
            $stmt->bindParam(':sem', $sem, PDO::PARAM_STR);
    
            // Execute the statement
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log it or display an error message)
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function hardDeleteFacultySubjectBySection($id) {
        try {
            // Prepare the SQL statement with placeholders
            $sql = "DELETE FROM faculty_subject_section 
            WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
    
            // Bind parameters to the placeholders
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    
            // Execute the statement
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log it or display an error message)
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function hardDeleteCalendar($user_id,$id) {
        try {
            // Prepare the SQL statement with placeholders
            $sql = "DELETE FROM calendar 
            WHERE `user_id` = :user_id AND id = :id";
            $stmt = $this->pdo->prepare($sql);
    
            // Bind parameters to the placeholders
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
            // Execute the statement
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log it or display an error message)
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    public function getIdByColumnValue($tableName, $columnName, $columnValue, $idColumnName) {
        try {
            $stmt = $this->pdo->prepare("SELECT $idColumnName FROM $tableName WHERE $columnName = :column_value");
            $stmt->bindParam(':column_value', $columnValue);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                return $result[$idColumnName];
            } else {
                return null; // Entry not found
            }
        } catch (PDOException $e) {
            // echo "Error retrieving ID: " . $e->getMessage();
            return null;
        }
    }

    public function getIdByColumnValueWhere($tableName, $conditions, $idColumnName) {
        try {
            // Build the WHERE clause based on the array of conditions
            $whereClauses = [];
            foreach ($conditions as $column => $value) {
                $whereClauses[] = "$column = :$column"; // Create placeholders for each column
            }
    
            // Join the WHERE conditions with "AND"
            $whereSql = implode(' AND ', $whereClauses);
    
            // Prepare the SQL statement
            $sql = "SELECT $idColumnName FROM $tableName WHERE $whereSql";
            $stmt = $this->pdo->prepare($sql);
    
            // Bind each value to the corresponding placeholder
            foreach ($conditions as $column => $value) {
                $stmt->bindValue(":$column", $value);
            }
    
            // Execute the statement
            $stmt->execute();
            
            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                return $result[$idColumnName];
            } else {
                return null; // Entry not found
            }
        } catch (PDOException $e) {
            // Handle error
            return null;
        }
    }

    public function getMaxDate($subject_id, $upload_id,$semester,$year) {
        // $image =($db->getIdByColumnValue('tableName', 'id',$_GET['post'],'image')
            try {
                $stmt = $this->pdo->prepare("SELECT * 
                FROM `faculty_uploads`
                WHERE `datetime_created` = (SELECT MAX(`datetime_created`) FROM `faculty_uploads`
                WHERE subject_id=:subject_id AND upload_id = :upload_id
                AND semester = :semester AND year = :year
                ) AND subject_id=:subject_id AND upload_id = :upload_id
                AND semester = :semester AND year = :year
                ");
                $stmt->bindParam(':subject_id', $subject_id);
                $stmt->bindParam(':upload_id', $upload_id);
                $stmt->bindParam(':semester', $semester);
                $stmt->bindParam(':year', $year);
                $stmt->execute();
                
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($result) {
                    return $result['datetime_created'];
                } else {
                    return null; // Entry not found
                }
            } catch (PDOException $e) {
                // echo "Error retrieving ID: " . $e->getMessage();
                return null;
            }
        }
        public function getMaxDateProctor($subject_id, $upload_id,$semester,$year,$section_id,$faculty_id) {
            // $image =($db->getIdByColumnValue('tableName', 'id',$_GET['post'],'image')
                try {
                    $stmt = $this->pdo->prepare("SELECT * 
                    FROM `faculty_uploads`
                    WHERE `datetime_created` = (SELECT MAX(`datetime_created`) FROM `faculty_uploads`
                    WHERE subject_id=:subject_id AND upload_id = :upload_id
                    AND semester = :semester AND year = :year
                    AND faculty_id = :faculty_id
                    AND section_id = :section_id
                    ) AND subject_id=:subject_id AND upload_id = :upload_id
                    AND semester = :semester AND year = :year
                    ");
                    $stmt->bindParam(':subject_id', $subject_id);
                    $stmt->bindParam(':upload_id', $upload_id);
                    $stmt->bindParam(':semester', $semester);
                    $stmt->bindParam(':year', $year);
                    $stmt->bindParam(':faculty_id', $faculty_id);
                    $stmt->bindParam(':section_id', $section_id);
                    $stmt->execute();
                    
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if ($result) {
                        return $result['datetime_created'];
                    } else {
                        return null; // Entry not found
                    }
                } catch (PDOException $e) {
                    // echo "Error retrieving ID: " . $e->getMessage();
                    return null;
                }
            }
    public function getCountByConditions($tableName, $conditions) {
        try {
            $sql = "SELECT COUNT(*) as count FROM $tableName WHERE status = 0"; // Always include status = 0
    
            if (!empty($conditions)) {
                $sql .= " AND "; // Since there's already a WHERE clause for status, use AND
                $whereConditions = [];
    
                foreach ($conditions as $column => $value) {
                    $whereConditions[] = "$column = :$column";
                }
    
                $sql .= implode(" AND ", $whereConditions);
            }
            // echo $sql;
            $stmt = $this->pdo->prepare($sql);
    
            foreach ($conditions as $column => $value) {
                // Use bindValue to bind the actual value rather than a reference
                $stmt->bindValue(":$column", $value);
            }
    
            $stmt->execute();
            $count = $stmt->fetchColumn();
    
            return $count;
        } catch (PDOException $e) {
            // Handle the exception as needed
            return null;
        }
    }

    public function getCounter($role, $college_id) {
        try {
            $sql = "SELECT COUNT(id) as count FROM department_details
WHERE depatment_college = $college_id AND status =0 AND department_secretary != 0"; // Always include status = 0
                        
            // echo $sql;
            $stmt = $this->pdo->prepare($sql);
    
            $stmt->execute();
            $count = $stmt->fetchColumn();
    
            return $count;
        } catch (PDOException $e) {
            // Handle the exception as needed
            return null;
        }
    }
    public function getCounterUsers($college_id) {
        try {
            $sql = "SELECT COUNT(a.id) as count FROM users 
                    as a 
                    JOIN department_faculty as b 
                    ON a.id = b.faculty_id
                    JOIN department_details as c 
                    ON b.department_id = c.id
                    WHERE c.depatment_college = '$college_id'  AND a.status =0 AND c.status =0 AND b.status = 0"; // Always include status = 0
                                            
            // echo $sql;
            $stmt = $this->pdo->prepare($sql);
    
            $stmt->execute();
            $count = $stmt->fetchColumn();
    
            return $count;
        } catch (PDOException $e) {
            // Handle the exception as needed
            return null;
        }
    }
    public function getCounterUsersDep($college_id) {
        try {
            $sql = "SELECT COUNT(a.id) as count FROM users 
                    as a 
                    JOIN college_user_added as b 
                    ON a.id = b.user_id
                    WHERE b.college_id = '$college_id'  AND a.status =0 AND b.status = 0"; // Always include status = 0
                                            
            // echo $sql;
            $stmt = $this->pdo->prepare($sql);
    
            $stmt->execute();
            $count = $stmt->fetchColumn();
    
            return $count;
        } catch (PDOException $e) {
            // Handle the exception as needed
            return null;
        }
    }
    
    public function getAllColumnsByColumnValue($tableName, $columnName, $columnValue) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM $tableName WHERE $columnName = :column_value");
            $stmt->bindParam(':column_value', $columnValue);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                return $result;
            } else {
                return null; // Entry not found
            }
        } catch (PDOException $e) {
            // Handle the exception here
            return null;
        }
    }
    public function getAllColumns($tableName) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM $tableName WHERE status = 0");
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                return $result;
            } else {
                return null; // Entry not found
            }
        } catch (PDOException $e) {
            // Handle the exception here
            return null;
        }
    }
 
    
}
?>
