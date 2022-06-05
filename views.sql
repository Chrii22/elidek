/*View 3.2-Project per Researcher*/
CREATE VIEW project_per_researcher as 
    SELECT ResearcherSIN, Researcher.firstName, Researcher.lastName, Project.title FROM Works_on INNER JOIN Researcher ON Works_on.ResearcherSIN = Researcher.SIN INNER JOIN Project on Works_on.ProjectID = Project.ID
    GROUP BY ResearcherSIN;
/*View 3.2ii-Project per Organization*/
CREATE VIEW project_per_organization AS 
   SELECT Organization.name, count(OrganizationID) as count
    FROM Project INNER JOIN Organization ON Project.OrganizationID = Organization.ID 
    GROUP BY Organization.name;