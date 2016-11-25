#### 接口说明，用一段文字来介绍本接口

***
## 1.1接口名称

**接口地址：**`Admin/AdminManageUrl/url`

**请求方式：**`post`

**数据提交示例：**
```json
{
   "id":1,
   "username":"李勃"
}
```
参数 | 是否必须 | 说明
-- | -- | --
id | yes | `number`用户ID
username | yes | `string`用户名

**数据返回示例：**
```json
{
   "Retcode":1,
   "msg":"成功",
   "data":
     {
       "isHandsome":true,
       "hisLook":["王力宏","吴彦祖","宋仲基"]
     }
}
```
参数 | 说明
-- | --
Retcode | `int`状态码
msg | `string`状态描述
data | `object`接口数据对象
isHandsome | `boolean`字段描述
hisLook | `array`字段描述
