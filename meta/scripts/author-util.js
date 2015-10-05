/*
 * Iterate through the authors array creating new html content for the authorDiv element.
 *
 * The authors array is a three-dimensional array with the following structure:
 *
 *     |    0     |       1       |       2       |                |    0    |     1      |         2         |
 *     +----------+---------------+---------------+                +---------+------------+-------------------+
 *   0 | Author 1 | Affiliation 1 | Affiliation 2 |    Affiliation | College | Department | Other Affiliation |
 *     +----------+---------------+---------------+                +---------+------------+-------------------+
 *   1 | Author 2 | Affiliation 1 | Affiliation 2 |
 *     +----------+---------------+---------------+
 *   2 | Author 3 | Affiliation 1 | Affiliation 2 |
 *     +----------+---------------+---------------+
 *
 * Note:  authors[i][0]    = Author Name
 *        authors[i][j][0] = MSU College where j > 0
 *        authors[i][j][1] = MSU Department where j > 0
 *        authors[i][j][2] = Other Affiliation where j > 0
 *
 */
function displayAuthors() {
	var authorDiv = "";
	for (i = 0; i < authors.length; i++) {
		authorDiv += ("<h3><label for=\"author\">Author " + (i + 1) + "  [Last, First Middle (or Middle Initial)]</label></h3>\n");
		authorDiv += ("<input class=\"text\" type=\"text\" id=\"author\" name=\"author" + i + "\" size=\"40\" maxlength=\"255\" value=\"" + authors[i][0] + "\"/>\n");
		authorDiv += ("&nbsp;&nbsp;<input class=\"submit\" type=\"button\" onClick=\"removeAuthor(" + i + ");\" value=\"Remove Author\" />\n");
		authorDiv += ("<h3><input class=\"submit\" type=\"button\" onClick=\"addAffiliation(" + i  + ");\" value=\"Add Affiliation\"/></h3>\n\n");

		for (j = 1; j < authors[i].length; j++) {
			authorDiv += ("<fieldset><legend>Author " + (i + 1) + " Affiliation " + j + "</legend>\n");
			authorDiv += ("<h3><input class=\"submit\" type=\"button\" onClick=\"removeAffiliation(" + i + ", " + j + ");\" value=\"Remove Affiliation\"/></h3>\n");
			authorDiv += ("<h3><label for=\"affiliation\">MSU College</label></h3>\n");
			authorDiv += ("<input class=\"text\" type=\"text\" id=\"affiliation\" name=\"affiliation" + i + "-" + j + "-0\" size=\"40\" maxlength=\"255\" value=\"" + authors[i][j][0] + "\"/>\n");
			authorDiv += ("<h3><label for=\"affiliation\">MSU Department</label></h3>\n");
			authorDiv += ("<input class=\"text\" type=\"text\" id=\"affiliation\" name=\"affiliation" + i + "-" + j + "-1\" size=\"40\" maxlength=\"255\" value=\"" + authors[i][j][1] + "\"/>\n");
			authorDiv += ("<h3><label for=\"affiliation\">Other Affiliation</label></h3>\n");
			authorDiv += ("<input class=\"text\" type=\"text\" id=\"affiliation\" name=\"affiliation" + i + "-" + j + "-2\" size=\"40\" maxlength=\"255\" value=\"" + authors[i][j][2] + "\"/>\n");
			authorDiv += "</fieldset>\n\n";
		}
	}
	authorDiv += ("<h3><input class=\"submit\" type=\"button\" onClick=\"addAuthor();\" value=\"Add Author\" /></h3>\n");
	$("#authorDiv").html(authorDiv);
}

/*
 * Rebuild the authors array in order to capture changes that may have been
 * made to the input fields.
 */
function getAuthorInfo() {
	authorNum = -1;
	authors = new Array();
	$("#authorDiv").find("#author, #affiliation").map(function() {
		if (this.id == "author") {
			authors[++authorNum] = new Array();

			// Author name is stored in authors[authorNum][0]
			authors[authorNum][0] = this.value;

			affiliationType = 0;
			affiliationNum = 1;
		}
		else {
			if (affiliationType == 0) {
				// Create affiliation array
				authors[authorNum][affiliationNum] = new Array();
			}
			authors[authorNum][affiliationNum][affiliationType++] = this.value;
			if (affiliationType == 3) {
				// Reached end of this affiliation -- set new affiliationType and affiliationNum
				affiliationType = 0;
				affiliationNum++;
			}
		}
	});
}

/*
 * Add an empty array element to the end of the authors array and redisplay.
 */
function addAuthor() {
	getAuthorInfo();

	authorNum = authors.length;
	if (authorNum == -1) {
		authorNum = 0;
	}
	authors[authorNum] = new Array();
	authors[authorNum][0] = "";  // Author Name
	authors[authorNum][1] = new Array();
	authors[authorNum][1][0] = "";  // MSU College
	authors[authorNum][1][1] = "";  // MSU Department
	authors[authorNum][1][2] = "";  // Other Affiliation

	displayAuthors();
}

/*
 * Add affiliation elements to the end of the authors[authorNum] array and redisplay.
 */
function addAffiliation(authorNum) {
	getAuthorInfo();

	affiliationNum = authors[authorNum].length;
	authors[authorNum][affiliationNum] = new Array();
	authors[authorNum][affiliationNum][0] = "";
	authors[authorNum][affiliationNum][1] = "";
	authors[authorNum][affiliationNum][2] = "";

	displayAuthors();
}

/*
 * Remove the specified author element from the authors array and redisplay.
 */
function removeAuthor(authorNum) {
	getAuthorInfo();

	authors.splice(authorNum, 1);

	displayAuthors();
}

/*
 * Remove the specified affiliation element from the specified author array element and redisplay.
 */
function removeAffiliation(authorNum, affiliationNum) {
	getAuthorInfo();

	authors[authorNum].splice(affiliationNum, 1);

	displayAuthors();
}
