#### 一般，一个文档中，会描述相同业务的几个接口，比如同一业务的增、删、查、改，建议写在同一个md文档之中。然后，在文档的最上方，用文字进行接口的描述。尽量详细的接口描述，可以有效降低开发时的沟通成本以及错误出现的几率。

***
## 2.1接口名称

**接口地址：**`Admin/AdminManageUrl/url`

**请求方式：**`post`

如果需要写一段文字来对文档中的某一个接口进行特别的描述，可以写在接口地址和请求方式的下方。同样，尽量做到详细描述。同时，为了便于理解业务逻辑，这里也可以插入图片
![示例图片](./img/jpg1.jpg)

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
