

#COURSE PLANNER

## WHAT IS THIS PROJECT?
Course Planner is to be a website that will enable students to efficiently and easily schedule reminders for all of their coursework. Using information collected from your peers, through a comprehensive course element rating system, as well as custom settings collected from the user, a scheduling system will generate helpful reminders directing you when to begin studying or working on certain assignments. Course Planner is unique to other existing scheduling applications in that it automatically creates and schedules reminders using both user’s preferences and information sourced from other students to allow easier study scheduling.



## WEBSITE ADDRESS
www.courseplanner.de

## TEAM MEMBERS

DATABASE<br />
1.Andrew Dombowsky<br />
2.Qianzhen Gao<br />
3.Pietr Crandall<br />

UI<br />
1.Diya Ren <br />
2.Mengxi Zhang<br />


##Know More About Our Design 
###1.Core features: <br />
a)Edit Courses Schedule:<br />
            1)Add course 
            2)Delete course 
            3)Edit course 


b)Reminder System:<br />
         1) Set a manual reminder
	 2) Set a rank-based reminder


c)Ranking and Modifying Course Features<br />
         1) Rank course feature
         2) Add new course feature
         3) Add information to existing feature


###Additional features:<br />
a)Create or login to user profile <br /> 
         1) Use facebook to login to Course Planner profile
      	 2) Create a new course planner profile after first login in with Facebook


###2.Architectural & Component-Level Design


LAMP<br />
	The web server is written in LAMP which is is an archetypal model of web service solution stacks, named as an acronym of the names of its original four open-source components: the Linux operating system, the Apache HTTP Server, the MySQL relational database management system, and the PHP programming language. LAMP is a suitable solution stack for building dynamic web sites and web applications. The model view is as follow image.

<br>
<img heigh="700" src=https://github.com/lukeZhangMengxi/CoursePlanner321P/blob/master/readmeIMG/Screen%20Shot%202016-11-10%20at%2010.07.51%20AM.png/>
<br>

Linux operating system<br />
	Linux is a Unix-like and mostly POSIX-compliant computer operating system (OS) assembled under the model of free and open-source software development and distribution. The defining component of Linux is the Linux kernel, an operating system kernel first released on September 17, 1991 by Linus Torvalds. The Free Software Foundation uses the name GNU/Linux to describe the operating system, which has led to some controversy. Source: https://en.wikipedia.org/wiki/Linux


LAMP is required to use Linux operating system to manage, edit and modify our web application.


Amazon web services<br />
	AWS a subsidiary of Amazon.com, offers a suite of cloud-computing services that make up an on-demand computing platform. These services operate from 13 geographical regions across the world. The most central and best-known of these services arguably include Amazon Elastic Compute Cloud, also known as "EC2", and Amazon Simple Storage Service, also known as "S3". As of 2016 AWS has more than 70 services, spanning a wide range, including compute, storage, networking, database, analytics, application services, deployment, management, mobile, developer tools and tools for the Internet of things. Amazon markets AWS as a service to provide large computing capacity quicker and cheaper than a client company building an actual physical server farm. Source: https://en.wikipedia.org/wiki/Amazon_Web_Services
	
We have chosen Amazon web services as our application’s web server, because it is free and provides the LAMP platform for building web applications. All the related web application’s files will push up to AWS for running the actual web application.


MySQL<br />
	MySQL is an open-source relational database management system (RDBMS). Its name is a combination of "My", the name of co-founder Michael Widenius' daughter, and "SQL", the abbreviation for Structured Query Language. The MySQL development project has made its source code available under the terms of the GNU General Public License, as well as under a variety of proprietary agreements. MySQL was owned and sponsored by a single for-profit firm, the Swedish company MySQL AB, now owned by Oracle Corporation. For proprietary use, several paid editions are available, and offer additional functionality. MySQL is a central component of the LAMP open-source web application software stack. Source: https://en.wikipedia.org/wiki/MySQL


PHP programing language <br />
	PHP is a server-side scripting language designed primarily for web development but is also used as a general-purpose programming language. Originally created by Rasmus Lerdorf in 1994, the PHP reference implementation is now produced by The PHP Development Team. PHP originally stood for Personal Home Page, but it now stands for the recursive acronym PHP: Hypertext Preprocessor. Source: https://en.wikipedia.org/wiki/PHP


3.Data<br />
	Our Web Server Entity-Relationship (ER) Diagram is as follows:
<br>
<img heigh="700" src=https://github.com/lukeZhangMengxi/CoursePlanner321P/blob/master/readmeIMG/Screen%20Shot%202016-11-10%20at%2010.08.19%20AM.png/>
<br>



	Students and Professors/TAs need to register a Web Server account to access the course schedule system, reminder system and ranking and modified course system. The course schedule system will display the related course id, schedule, outline and professors/TAs contact information. The reminder system will be used to remind the assignments and exams. Students can set the remind system to re-remind or do not remind. Professors/TAs can edit the remind system to post the assignments and exams. The ranking system is used to ranked the related assignments and exams difficulty.


###4.User Interface Design <br />
	The user interface mainly includes login view, schedule panel, reminder panel, workload ranking panel, and contact and help panel. The login view is used to allow users to login with their facebook account, which requires a facebook login module to support the function. After the user logs into their account, they will be able to navigate through all the following four panels on a sidebar. Users could open or hide the sidebar by clicking opening button or close button. The panels will display user’s private information related to their account, and users could modify their schedule, set reminder requirements, rank workload of certain class work and get contact and help from our design team on corresponding panels. All the panels are able to access certain parts of our server end database to retrieve or update information. Also, there should be a reminder module to support its functionality.

a)Dashboard View:

<br>
<img heigh="700" src=https://github.com/lukeZhangMengxi/CoursePlanner321P/blob/master/readmeIMG/Screen%20Shot%202016-11-10%20at%209.48.50%20AM.png />
<br>


b)Facebook Login View:

<br>
<img heigh="700" src=https://github.com/lukeZhangMengxi/CoursePlanner321P/blob/master/readmeIMG/Screen%20Shot%202016-11-10%20at%209.50.42%20AM.png/>
<br>


c)First login Info Enter Page View:


<br>
<img heigh="700" src=https://github.com/lukeZhangMengxi/CoursePlanner321P/blob/master/readmeIMG/Screen%20Shot%202016-11-10%20at%209.51.04%20AM.png/>
<br>

d)Check Your Task Button View 
<br>
<img heigh="700" src=https://github.com/lukeZhangMengxi/CoursePlanner321P/blob/master/readmeIMG/Screen%20Shot%202016-12-02%20at%2011.57.13%20PM.png/>
<br>

e)Tasks Display View

<br>
<img heigh="700" src=https://github.com/lukeZhangMengxi/CoursePlanner321P/blob/master/readmeIMG/Screen%20Shot%202016-12-02%20at%2011.57.26%20PM.png/>
<br>

f)Sidebar Select View:

<br>
<img heigh="700" src=https://github.com/lukeZhangMengxi/CoursePlanner321P/blob/master/readmeIMG/Screen%20Shot%202016-12-02%20at%2011.58.23%20PM.png/>
<br>


g)Course Information Edit Page View:

<br>
<img heigh="700" src=https://github.com/lukeZhangMengxi/CoursePlanner321P/blob/master/readmeIMG/Screen%20Shot%202016-12-03%20at%2012.06.51%20AM.png/>
<br>


<br>
<img heigh="700" src=https://github.com/lukeZhangMengxi/CoursePlanner321P/blob/master/readmeIMG/Screen%20Shot%202016-12-03%20at%2012.06.57%20AM.png/>
<br>

<br>
<img heigh="700" src=https://github.com/lukeZhangMengxi/CoursePlanner321P/blob/master/readmeIMG/Screen%20Shot%202016-12-03%20at%2012.07.04%20AM.png/>
<br>

###5.Restrictions, limitations, and constraints <br />
The most important constraint will be the scope of this project. The scale of the client right now is limited to the student who are attend in same classes. In the future, we may want our project will be able to use widely in different faculties or even a whole university. As the number of clients and the scope of project increase, it is likely require more time to maintain the website and more money support on this project in order to keep it running functionality.


###6.GUI<br />
The user interface is built using HTML, CSS, PHP and Javascript libraries.




###7.Validation<br />
The UI validation will be a preceding process with the involvement of the clients. The design progress is based on a weekly basis and client feedback taken into account to design the user interface as user friendly as possible in order to ensures that the product actually meets the user's needs, and that the specifications were correct in the first place. 




###8.Changes and Rationale<br />

The most significant changes made to the design is due to relaxing our requirement to distinguish between students and TAs/professors. This exclusion only affects our database. Our database is now simpler than it was before and excludes some functions from needing to be implemented on the server. All assignments and exams will now be added and ranked by students, as this now our only type of user. We will no longer be showing any user profile information that is not directly pertinent to said user; only their name, contact information etc. 



# CPEN321CoursePlanner
