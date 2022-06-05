/* Query  3.1-Active Porjects*/
SELECT Project.ID, Project.title, Project.summary, Project.startDate, Project.endDate, Project.duration FROM Project WHERE current_timestamp between startDate and endDate

/* Query  3.1-Researcher per Porject*/
SELECT Researcher.SIN, Researcher.firstName, Researcher.lastName
FROM Works_on INNER JOIN Researcher ON Works_on.ResearcherSIN = Researcher.SIN 
WHERE Works_on.ProjectID = input_from_form

/* Query  3.1-Project Start and End Date*/
SELECT Project.ID, Project.title, Project.startDate, Project.endDate, Project.duration FROM Project WHERE startDate > input and endDate < input_from_form

/* Query  3.1-Project Duration*/
SELECT  Project.ID, Project.title, Project.startDate, Project.endDate, Project.duration FROM Project WHERE duration < input 

/* Query  3.1-Executive per Project*/
SELECT Executive.SIN, Executive.firstName, Executive.lastName, Project.title
FROM Project INNER JOIN Executive ON Project.ExecutiveSIN = Executive.SIN 
WHERE Project.ExecutiveSIN = input_from_form

/* Query  3.3*/
SELECT Researcher.SIN, Researcher.firstName, Researcher.lastName, Project.title
FROM Works_on INNER JOIN  (SELECT ProjectID 
							FROM Project_Field INNER JOIN Project ON Project_Field.ProjectID = Project.ID 
							WHERE Project_Field.FieldID = 5 and Project.endDate > current_timestamp) 
				as Query1 ON Works_on.ProjectID = Query1.ProjectID 
				INNER JOIN Researcher ON Works_on.ResearcherSIN = Researcher.SIN INNER JOIN Project ON Query1.ProjectID = Project.ID
WHERE TIMESTAMPDIFF(YEAR, Works_on.startDate, CURDATE()) <= 1


/* Query 3.4*/
SELECT DISTINCT org2.name, org1.count_projects
FROM (SELECT OrganizationID, count(OrganizationID) as count_projects, Organization.name
        FROM Project INNER JOIN Organization on Project.OrganizationID = Organization.ID
        WHERE TIMESTAMPDIFF(YEAR, Project.startDate, current_timestamp) <= 2
            GROUP BY OrganizationID
            having count_projects > 0 ) as org1 INNER JOIN
(SELECT OrganizationID, count(OrganizationID) as count_projects, Organization.name
        FROM Project INNER JOIN Organization on Project.OrganizationID = Organization.ID
        WHERE TIMESTAMPDIFF(YEAR, Project.startDate, current_timestamp) <= 2
            GROUP BY OrganizationID
            having count_projects > 0 ) as org2
						on org1.count_projects = org2.count_projects
WHERE org1.OrganizationID < org2.OrganizationID
ORDER BY org1.count_projects

/*Query 3.5*/
SELECT PF.FieldID, twofields.FieldID, count(*) as count
FROM (SELECT ProjectID, FieldID FROM Project_Field HAVING count(ProjectID) = 2) AS PF INNER JOIN 
(SELECT ProjectID, FieldID FROM Project_Field HAVING count(ProjectID) = 2) AS twofields ON twofields.ProjectID = PF.ProjectID
WHERE PF.FieldID < twofields.FieldID
GROUP BY twofields.FieldID, PF.FieldID
ORDER BY count DESC limit 3

/*Query 3.6*/
SELECT Researcher.firstName, Researcher.lastName, Researcher.age, count(ProjectID) as count
    FROM Researcher INNER JOIN Works_on ON Researcher.SIN = Works_on.ResearcherSIN INNER JOIN Project ON Project.ID = Works_on.ProjectID
    WHERE Researcher.age < 40 and current_timestamp BETWEEN Project.startDate AND Project.endDate
    GROUP BY Researcher.SIN
    ORDER BY count(ProjectID) DESC, Researcher.age ASC

/*Query 3.7*/
SELECT Executive.firstName, Executive.lastName, Organization.name as Company, sum(amount) as total_amount
FROM Project INNER JOIN Executive ON Project.ExecutiveSIN = Executive.SIN 
INNER JOIN Organization ON Project.OrganizationID = Organization.ID 
WHERE Organization.or_type = 'Company'
GROUP BY Executive.SIN
ORDER BY sum(amount) DESC limit 5

/*Query 3.8*/
SELECT Researcher.firstName,Researcher.lastName, count(ProjectID) AS count
FROM works_on INNER JOIN researcher ON works_on.ResearcherSIN = Researcher.SIN 
WHERE works_on.ProjectID NOT IN  (SELECT projectID FROM sub_project) 
GROUP BY researcher.SIN 
HAVING count(ProjectID) > 0
ORDER BY count DESC
