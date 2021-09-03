Feature: Add A article
  In order to retrieve the article
  As a user
  I must visit the customers page

  Scenario: I want add new article

    When I add article with title  "samyemad" and description "test test"
    And I add comment with name "samy" and description "test test" and email "samyemad4@gmail.com"
    Then The results should include a article with comment count "1"
