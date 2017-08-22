define({ "api": [
  {
    "type": "get",
    "url": "getCourseList",
    "title": "获取课程列表",
    "name": "getCourseList",
    "group": "Course",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "status",
            "description": "<p>结果状态值，0：请求失败；1：请求成功</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "info",
            "description": "<p>返回状态说明，status为0时，info返回错误原因，否则返回“OK”</p>"
          },
          {
            "group": "Success 200",
            "type": "array",
            "optional": false,
            "field": "data",
            "description": "<p>返回数据</p>"
          },
          {
            "group": "Success 200",
            "type": "integer",
            "optional": false,
            "field": "data.id",
            "description": "<p>课程ID</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.name",
            "description": "<p>课程名称</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.number",
            "description": "<p>排序</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": 1,\n\"info\": \"ok\",\n\"data\": [\n{\n\"id\": 1,\n\"name\": \"Java\",\n\"number\": 9\n},\n{\n\"id\": 2,\n\"name\": \"PHP\",\n\"number\": 1\n},\n{\n\"id\": 3,\n\"name\": \"ASP.NET\",\n\"number\": 2\n},\n{\n\"id\": 4,\n\"name\": \"C/C++\",\n\"number\": 3\n},",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/CourseController.php",
    "groupTitle": "Course",
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404",
            "description": "<p>Not Found 接口不存在</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "404 Not Found:",
          "content": "HTTP/1.1 404 Not Found\n{\n \"message\": \"404 Not Found\",\n \"status_code\": 404\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "getIndustryList",
    "title": "获取行业列表",
    "name": "getIndustryList",
    "group": "Industry",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "status",
            "description": "<p>结果状态值，0：请求失败；1：请求成功</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "info",
            "description": "<p>返回状态说明，status为0时，info返回错误原因，否则返回“OK”</p>"
          },
          {
            "group": "Success 200",
            "type": "array",
            "optional": false,
            "field": "data",
            "description": "<p>返回数据</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.id",
            "description": "<p>行业id</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.name",
            "description": "<p>行业名称</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": 1,\n\"info\": \"ok\",\n\"data\": [\n{\n\"id\": 1,\n\"name\": \"软件开发\"\n}\n]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/IndustryController.php",
    "groupTitle": "Industry",
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404",
            "description": "<p>Not Found 接口不存在</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "404 Not Found:",
          "content": "HTTP/1.1 404 Not Found\n{\n \"message\": \"404 Not Found\",\n \"status_code\": 404\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "getSpecialtyList",
    "title": "获取技能列表",
    "name": "getSpecialtyList",
    "group": "Special",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程id，可传参数(课程id或教师id 2选1)</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "teacher_id",
            "description": "<p>教师id，可传参数(课程id或教师id 2选1)</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page_size",
            "description": "<p>分页，可传参数(默认每页10条)</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>翻页，可传参数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "status",
            "description": "<p>结果状态值，0：请求失败；1：请求成功</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "info",
            "description": "<p>返回状态说明，status为0时，info返回错误原因，否则返回“OK”</p>"
          },
          {
            "group": "Success 200",
            "type": "array",
            "optional": false,
            "field": "data",
            "description": "<p>返回数据</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.current_page",
            "description": "<p>当前页</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.last_page",
            "description": "<p>最大页数</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.total",
            "description": "<p>总条数</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.id",
            "description": "<p>技能id</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.specialty_name",
            "description": "<p>技能名称</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.teacher_name",
            "description": "<p>教师名称</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.buy_number",
            "description": "<p>购买数量</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.look_number",
            "description": "<p>观看(点击)数量</p>"
          },
          {
            "group": "Success 200",
            "type": "decimal",
            "optional": false,
            "field": "data.old_price",
            "description": "<p>原价</p>"
          },
          {
            "group": "Success 200",
            "type": "decimal",
            "optional": false,
            "field": "data.price",
            "description": "<p>现价</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.image",
            "description": "<p>图片相对路径</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": 1,\n\"info\": \"ok\",\n\"data\": {\n\"current_page\": 1,\n\"data\": [\n{\n\"id\": 1,\n\"specialty_name\": \"PHP入门知识\",\n\"teacher_name\": \"王先生\",\n\"buy_number\": 0,\n\"look_number\": 0,\n\"old_price\": \"0.00\",\n\"price\": \"150.00\",\n\"image\": \"specialty_images/1502097686_84946300.jpg\"\n}\n],\n\"from\": 1,\n\"last_page\": 3,\n\"next_page_url\": \"http://weibaner.dev/api/getSpecialtyList?page=2\",\n\"path\": \"http://weibaner.dev/api/getSpecialtyList\",\n\"per_page\": 1,\n\"prev_page_url\": null,\n\"to\": 1,\n\"total\": 3\n}\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/SpecialtyController.php",
    "groupTitle": "Special",
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404",
            "description": "<p>Not Found 接口不存在</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "404 Not Found:",
          "content": "HTTP/1.1 404 Not Found\n{\n \"message\": \"404 Not Found\",\n \"status_code\": 404\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "addStudent",
    "title": "学生注册",
    "name": "addStudent",
    "group": "Student",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "account",
            "description": "<p>账号,必传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "pwd",
            "description": "<p>密码,必传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "name",
            "description": "<p>姓名,可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "phone",
            "description": "<p>电话,可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>邮箱，可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "city_code",
            "description": "<p>城市代码，可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "address",
            "description": "<p>地址，可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "sex",
            "description": "<p>性别1男2女，可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "date",
            "optional": false,
            "field": "birth",
            "description": "<p>生日，可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "is_prof",
            "description": "<p>是否在职0在校1在职，可传参数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "status",
            "description": "<p>结果状态值，0：请求失败；1：请求成功</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "info",
            "description": "<p>返回状态说明，status为0时，info返回错误原因，否则返回“OK”</p>"
          },
          {
            "group": "Success 200",
            "type": "array",
            "optional": false,
            "field": "data",
            "description": "<p>返回新增的id -1等于失败</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": 1,\n\"info\": \"ok\",\n\"data\": 8\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentController.php",
    "groupTitle": "Student",
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404",
            "description": "<p>Not Found 接口不存在</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "404 Not Found:",
          "content": "HTTP/1.1 404 Not Found\n{\n \"message\": \"404 Not Found\",\n \"status_code\": 404\n}",
          "type": "json"
        }
      ]
    }
  }
] });
