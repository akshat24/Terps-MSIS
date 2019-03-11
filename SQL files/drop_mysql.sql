DROP TABLE TerpsMSIS.Study;
DROP TABLE TerpsMSIS.Hires;
DROP TABLE TerpsMSIS.Possess;
DROP TABLE TerpsMSIS.Taken;
DROP TABLE TerpsMSIS.Requires;
DROP TABLE TerpsMSIS.Course;
DROP TABLE TerpsMSIS.Major;
DROP TABLE TerpsMSIS.University;
DROP TABLE TerpsMSIS.Skill;
DROP TABLE TerpsMSIS.Company;
DROP TABLE TerpsMSIS.Alumni;

DROP TABLE Enterprise.Dependent;
DROP TABLE Enterprise.Work;
DROP TABLE Enterprise.Project;
DROP TABLE Enterprise.DepartmentLocation;

ALTER TABLE Enterprise.Employee 
DROP CONSTRAINT fk_Emp_dptId;

DROP TABLE Enterprise.Department;
DROP TABLE Enterprise.Employee;