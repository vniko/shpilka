define({ "api": [
  {
    "type": "get",
    "url": "/departments/dates/:id/:date",
    "title": "GetDepartmentDates",
    "name": "GetDepartmentDates",
    "group": "grpDepartment",
    "description": "<p>Get department's available time slots grouped by dates</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Department's ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "date",
            "description": "<p>Date for month to use, if no date provided, current month is used</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample request:",
          "content": "{\n      \"id\": \"1\",\n      \"date\": \"2017-01-01\",\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "data",
            "description": "<p>Object with dates as keys and time slot arrays as values</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample response:",
          "content": "{\n  \"data\":\n     {\n         \"dates\":\n             {\n                 \"2017-07-02\":{\"08:00\":{\"available\":6},\"09:00\":{\"available\":6}},...\n             },\n          \"department\":{\n                 \"id\":1,\n                 \"title\": \"\\u041f\\u0435\\u0449\\u0435\\u0440\\u0430\",\n                 \"visit_capacity\":6,\n                 \"use_masters\":0,\n                 \"masters\":[]\n         }\n   }\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/DepartmentController.php",
    "groupTitle": "Department",
    "groupDescription": "<p>Working with department entity</p>"
  },
  {
    "type": "get",
    "url": "/masters/dates/:id/:date",
    "title": "GetMasterDates",
    "name": "GetMasterDates",
    "group": "grpMaster",
    "description": "<p>Get master's available time slots grouped by dates</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Master's ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "date",
            "description": "<p>Date for month to use, if no date provided, current month is used</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample request:",
          "content": "{\n      \"id\": \"1\",\n      \"date\": \"2017-01-01\",\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "data",
            "description": "<p>Object with dates as keys and time slot arrays as values</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample response:",
          "content": "{\n   \"data\": {\n      \"2017-07-02\":[\"08:00\",\"09:00\"],\n      \"2017-07-07\":[\"09:00\",\"09:45\"]\n   }\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/MasterController.php",
    "groupTitle": "Master",
    "groupDescription": "<p>Working with Master entity</p>"
  }
] });
