define({ "api": [
  {
    "type": "get",
    "url": "getAdList",
    "title": "获取广告列表",
    "name": "getAdList",
    "group": "Ad",
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
            "description": "<p>广告id</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.title",
            "description": "<p>广告标题</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.image",
            "description": "<p>广告图片</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.link_address",
            "description": "<p>广告地址</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": 1,\n\"info\": \"ok\",\n\"data\": [\n{\n\"id\": 1,\n\"title\": \"广告1\",\n\"image\": \"specialty_images/1503369608_88542300.jpg\",\n\"link_address\": \"www.baidu.com\"\n}\n]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AdController.php",
    "groupTitle": "Ad",
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
    "url": "CommentUp",
    "title": "评论点赞和反点",
    "name": "CommentUp",
    "group": "Comment",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "comment_id",
            "description": "<p>课程id,必传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "stu_id",
            "description": "<p>学生id,必传参数</p>"
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
    "filename": "app/Http/Controllers/Api/CommentController.php",
    "groupTitle": "Comment",
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
    "url": "addComment",
    "title": "添加评论",
    "name": "addComment",
    "group": "Comment",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程id,必传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "stu_id",
            "description": "<p>学生id,必传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level",
            "description": "<p>评论等级,可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>姓名,可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "parent_id",
            "description": "<p>上一级id，可传参数</p>"
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
    "filename": "app/Http/Controllers/Api/CommentController.php",
    "groupTitle": "Comment",
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
    "url": "getCommentList",
    "title": "获取评论列表",
    "name": "getCommentList",
    "group": "Comment",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程id，必传参数</p>"
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
            "field": "data.id",
            "description": "<p>评论id</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.course_id",
            "description": "<p>课程id</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.level",
            "description": "<p>评论等级</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.message",
            "description": "<p>评论内容</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.stu_id",
            "description": "<p>学生id</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.student_name",
            "description": "<p>学生名称</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.parent_id",
            "description": "<p>上一级id</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.good_num",
            "description": "<p>点赞数</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": 1,\n\"info\": \"ok\",\n\"data\": {\n\"current_page\": 1,\n\"data\": [\n{\n\"id\": 1,\n\"course_id\": 1,\n\"level\": 1,\n\"message\": \"这个课程很不错\",\n\"stu_id\": 1,\n\"parent_id\": 0,\n\"created_at\": \"2017-08-22 15:43:53\",\n\"student_name\": \"张三\",\n\"good_num\": 2\n},\n{\n\"id\": 2,\n\"course_id\": 1,\n\"level\": null,\n\"message\": \"老师讲的真好\",\n\"stu_id\": 2,\n\"parent_id\": 0,\n\"created_at\": \"2017-08-22 15:44:08\",\n\"student_name\": \"李四\",\n\"good_num\": 1\n},\n{\n\"id\": 3,\n\"course_id\": 1,\n\"level\": null,\n\"message\": \"我没听懂\",\n\"stu_id\": 3,\n\"parent_id\": 0,\n\"created_at\": \"2017-08-22 15:44:25\",\n\"student_name\": \"王五\",\n\"good_num\": 1\n},\n{\n\"id\": 4,\n\"course_id\": 1,\n\"level\": null,\n\"message\": \"下次还要来\",\n\"stu_id\": 4,\n\"parent_id\": 0,\n\"created_at\": \"2017-08-22 15:44:29\",\n\"student_name\": \"赵六\",\n\"good_num\": 3\n}\n],\n\"from\": 1,\n\"last_page\": 1,\n\"next_page_url\": null,\n\"path\": \"http://weibaner.dev/api/getCommentList\",\n\"per_page\": 10,\n\"prev_page_url\": null,\n\"to\": 4,\n\"total\": 4\n}\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/CommentController.php",
    "groupTitle": "Comment",
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
    "url": "getCourseDetail",
    "title": "获取课程详情",
    "name": "getCourseDetail",
    "group": "Course",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程id,必传参数</p>"
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
            "type": "int",
            "optional": false,
            "field": "info.course_id",
            "description": "<p>课程ID</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "info.course_name",
            "description": "<p>课程名称</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "info.room_name",
            "description": "<p>教室名称</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "info.roomaddress",
            "description": "<p>教室地址</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "info.start_time",
            "description": "<p>开始时间</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "info.end_time",
            "description": "<p>结束时间</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "info.maximum",
            "description": "<p>教室最大人数</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "info.teacher_name",
            "description": "<p>教师名称</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "info.specInfo",
            "description": "<p>技能介绍</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "info.teachInfo",
            "description": "<p>教师信息</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "info.title",
            "description": "<p>教师头衔</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "info.image",
            "description": "<p>教师图片</p>"
          },
          {
            "group": "Success 200",
            "type": "array",
            "optional": false,
            "field": "specialty_list",
            "description": "<p>返回数据</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "specialty_list.id",
            "description": "<p>技能id</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "specialty_list.name",
            "description": "<p>技能名称</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "specialty_list.info",
            "description": "<p>技能信息</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": 1,\n\"info\": \"ok\",\n\"data\": {\n\"info\": [\n{\n\"course_id\": 1,\n\"course_name\": \"Java\",\n\"room_name\": \"教室一\",\n\"roomaddress\": \"南湖大道148号15楼A\",\n\"maximum\": 40,\n\"teacher_name\": \"王先生\",\n\"specInfo\": null,\n\"teachInfo\": null,\n\"start_time\": \"2017-08-22 00:00:00\",\n\"end_time\": \"2017-08-26 00:00:00\",\n\"title\": null,\n\"image\": \"teacher_images/1502866470_31445600.jpg\"\n}\n],\n\"specialty_list\": [\n{\n\"id\": 1,\n\"name\": \"PHP入门知识\",\n\"info\": \"PHP入门知识PHP入门知识\"\n},\n{\n\"id\": 3,\n\"name\": \"高级PHP\",\n\"info\": \"PHP\"\n}\n]\n}\n}",
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
    "url": "getCourseList",
    "title": "获取课程列表",
    "name": "getCourseList",
    "group": "Course",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "industry_id",
            "description": "<p>行业id,可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "is_heat",
            "description": "<p>是否热门0否1是,可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "teacher_id",
            "description": "<p>教师id,可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_type",
            "description": "<p>课程类型1/2   分享/培训,可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "city_code",
            "description": "<p>城市代码,可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "order_by",
            "description": "<p>排序字段,可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "order_by_type",
            "description": "<p>0升1降,可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page_size",
            "description": "<p>每页数量默认10,可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>第几页,可传参数</p>"
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
            "type": "int",
            "optional": false,
            "field": "data.course_type",
            "description": "<p>课程类型1/2   分享/培训</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.buy_number",
            "description": "<p>购买数量</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.click_number",
            "description": "<p>点击数量</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.old_price",
            "description": "<p>原始价格</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.price",
            "description": "<p>现价</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.is_heat",
            "description": "<p>是否热门0否1是</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.image",
            "description": "<p>图片</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.start_time",
            "description": "<p>开始时间</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.end_time",
            "description": "<p>结束时间</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "current_page",
            "description": "<p>当前页</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "total",
            "description": "<p>总条数</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "last_page",
            "description": "<p>总页数</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": 1,\n\"info\": \"ok\",\n\"data\": [\ncurrent_page\": 1,\n{\n\"id\": 1,\n\"name\": \"Java\",\n\"course_type\": 1,\n\"buy_number\": 0,\n\"click_number\": 0,\n\"old_price\": \"100.00\",\n\"price\": \"99.00\",\n\"is_heat\": 1,\n\"image\": \"specialty_images/1503368798_06412900.jpg\"\n\"start_time\": \"2017-08-22 00:00:00\",\n\"end_time\": \"2017-08-26 00:00:00\"\n}\n]\n}",
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
    "type": "post",
    "url": "FavoritesCourse",
    "title": "收藏",
    "name": "FavoritesCourse",
    "group": "Favorites",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程id,必传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "stu_id",
            "description": "<p>学生id,必传参数</p>"
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
            "description": "<p>返回新增的id -1等于失败 存在=删除反之新增</p>"
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
    "filename": "app/Http/Controllers/Api/FavoritesController.php",
    "groupTitle": "Favorites",
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
    "url": "getFavoritesList",
    "title": "获取学生收藏列表",
    "name": "getFavoritesList",
    "group": "Favorites",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "stu_id",
            "description": "<p>学生id,必传参数</p>"
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
            "field": "data.id",
            "description": "<p>收藏列表id</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.stu_id",
            "description": "<p>学生id</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.course_id",
            "description": "<p>课程id</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.course_name",
            "description": "<p>课程名称</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.image",
            "description": "<p>课程图片</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": 1,\n\"info\": \"ok\",\n\"data\": {\n\"current_page\": 1,\n\"data\": [\n{\n\"id\": 1,\n\"stu_id\": 1,\n\"course_id\": 1,\n\"course_name\": \"Java\",\n\"image\": \"specialty_images/1503368798_06412900.jpg\"\n}\n],\n\"from\": 1,\n\"last_page\": 1,\n\"next_page_url\": null,\n\"path\": \"http://weibaner.dev/api/getFavoritesList\",\n\"per_page\": 15,\n\"prev_page_url\": null,\n\"to\": 1,\n\"total\": 1\n}\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/FavoritesController.php",
    "groupTitle": "Favorites",
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
    "type": "post",
    "url": "addOrder",
    "title": "提交订单",
    "name": "addOrder",
    "group": "Order",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程id,必传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "stu_id",
            "description": "<p>学生id,必传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "buy_num",
            "description": "<p>上课人数,可传参数默认1</p>"
          },
          {
            "group": "Parameter",
            "type": "decimal",
            "optional": false,
            "field": "amount",
            "description": "<p>应付金额,可传参数默认0</p>"
          },
          {
            "group": "Parameter",
            "type": "decimal",
            "optional": false,
            "field": "price",
            "description": "<p>实付金额,可传参数默认0</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "pay_type",
            "description": "<p>支付方式0现金1支付宝2微信3银联,可传参数默认0</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "order_state",
            "description": "<p>支付状态0待支付1已支付2已退款3退款中4完成,可传参数默认0</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "remark",
            "description": "<p>备注,可传参数</p>"
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
            "field": "data.id",
            "description": "<p>广告id</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.title",
            "description": "<p>广告标题</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.image",
            "description": "<p>广告图片</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.link_address",
            "description": "<p>广告地址</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": 1,\n\"info\": \"ok\",\n\"data\": [\n{\n\"id\": 1,\n\"title\": \"广告1\",\n\"image\": \"specialty_images/1503369608_88542300.jpg\",\n\"link_address\": \"www.baidu.com\"\n}\n]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/OrderController.php",
    "groupTitle": "Order",
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
    "url": "getOrderList",
    "title": "获取订单信息",
    "name": "getOrderList",
    "group": "Order",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "stu_id",
            "description": "<p>学生id,必传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程id,可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "order_state",
            "description": "<p>支付状态0待支付1已支付2已退款3退款中4完成,可传参数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page_size",
            "description": "<p>分页,可传参数默认每页10行</p>"
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
            "field": "data.id",
            "description": "<p>订单id</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.stu_id",
            "description": "<p>学生id</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.course_id",
            "description": "<p>课程id</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.price",
            "description": "<p>实付金额</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.remark",
            "description": "<p>备注</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.pay_time",
            "description": "<p>付款时间</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.created_at",
            "description": "<p>下单时间</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.order_state",
            "description": "<p>支付状态0待支付1已支付2已退款3退款中4完成,可传参数默认0</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.refund_time",
            "description": "<p>退款时间</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.student_name",
            "description": "<p>学生名称</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.course_name",
            "description": "<p>课程名称</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": 1,\n\"info\": \"ok\",\n\"data\": {\n\"current_page\": 1,\n\"data\": [\n{\n\"id\": 6,\n\"stu_id\": 1,\n\"course_id\": 2,\n\"price\": \"0.00\",\n\"remark\": null,\n\"pay_time\": \"0000-00-00 00:00:00\",\n\"created_at\": null,\n\"order_state\": 1,\n\"pay_type\": 0,\n\"refund_time\": \"0000-00-00 00:00:00\",\n\"student_name\": \"张三\",\n\"course_name\": \"PHP\"\n}\n],\n\"from\": 1,\n\"last_page\": 1,\n\"next_page_url\": null,\n\"path\": \"http://weibaner.dev/api/getOrderList\",\n\"per_page\": 10,\n\"prev_page_url\": null,\n\"to\": 1,\n\"total\": 1\n}\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/OrderController.php",
    "groupTitle": "Order",
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
            "description": "<p>课程id，必传参数</p>"
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
            "field": "data.name",
            "description": "<p>技能名称</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.info",
            "description": "<p>技能信息</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": 1,\n\"info\": \"ok\",\n\"data\": {\n\"current_page\": 1,\n\"data\": [\n{\n\"id\": 1,\n\"name\": \"PHP入门知识\",\n\"info\": \"王先生\"\n}\n],\n\"from\": 1,\n\"last_page\": 3,\n\"next_page_url\": \"http://weibaner.dev/api/getSpecialtyList?page=2\",\n\"path\": \"http://weibaner.dev/api/getSpecialtyList\",\n\"per_page\": 1,\n\"prev_page_url\": null,\n\"to\": 1,\n\"total\": 3\n}\n}",
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
    "type": "get",
    "url": "LoginStu",
    "title": "学生登录",
    "name": "LoginStu",
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
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "data.id",
            "description": "<p>学生id</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.phone",
            "description": "<p>电话</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.email",
            "description": "<p>邮箱</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.name",
            "description": "<p>姓名</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.city_code",
            "description": "<p>城市代码</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.address",
            "description": "<p>地址</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.sex",
            "description": "<p>性别</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.birth",
            "description": "<p>生日</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.is_prof",
            "description": "<p>在职状态</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.city_name",
            "description": "<p>城市名称</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": 1,\n\"info\": \"ok\",\n\"data\": {\n\"id\": 7,\n\"name\": \"3\",\n\"phone\": \"4\",\n\"email\": \"5\",\n\"city_code\": \"180\",\n\"address\": \"7\",\n\"sex\": \"男\",\n\"birth\": \"2017-05-06\",\n\"is_prof\": 在校,\n\"city_name\": \"武汉市\"\n    }\n    }",
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
