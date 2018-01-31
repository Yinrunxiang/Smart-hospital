<template>
    <div>
        <div v-show="!setting && !treatting" class="p-20">
            <div class="m-b-20 ovf-hd">
                <div class="fl">
                    <!-- <el-button type="info" class="" @click="addressSetting">
                        <i class="el-icon-plus"></i>&nbsp;&nbsp;Add
                    </el-button> -->
                    <el-button type="warning" class="" @click="deleteBtn">
                        <i class="el-icon-minus"></i>&nbsp;&nbsp;Delete
                    </el-button>
                </div>
                <div class="fl w-300 m-l-30">
                    <el-input placeholder="Please enter the model" v-model="keywords">
                        <el-button slot="append" icon="search" @click="search()"></el-button>
                    </el-input>
                </div>
            </div>
            <el-table :data="tableData" style="width: 100%" @selection-change="selectItem" @row-dblclick="rowDblclick">
                <el-table-column type="selection" width="50">
                </el-table-column>
                <el-table-column label="Name" prop="name" width="150">
                </el-table-column>
                <el-table-column label="Sex" prop="sex" width="150">
                </el-table-column>
                <el-table-column label="Age" prop="age" width="150">
                </el-table-column>
                <el-table-column label="Title" prop="title" width="150">
                </el-table-column>
                <el-table-column label="Tel" prop="tel"  width="150">
                </el-table-column>
                <el-table-column label="Department" prop="department" width="150">
                </el-table-column>
                <el-table-column>
                  <template scope="scope">
                    <el-button type="primary" size="small" @click="treat(scope.row)">Treat</el-button>
                  </template>
                </el-table-column>
            </el-table>
            <div class="pos-rel p-t-20">
                <div>
                    <!-- <el-button size="small" type="success" @click="setStatusBtn('enabled')">Enabled</el-button>
                    <el-button size="small" type="warning" @click="setStatusBtn('disabled')">Disabled</el-button>
                    <el-button size="small" type="danger" @click="deleteBtn()">Delete</el-button> -->
                </div>
                <div class="block pages">
                    <el-pagination @current-change="handleCurrentChange" layout="prev, pager, next" :page-size="limit" :current-page="currentPage" :total="dataCount">
                    </el-pagination>
                </div>
            </div>
        </div>
        <div v-if="setting">
            <add :add="add" :selectData="selectData" @goback="goback"></add>
        </div>
        <div v-if="treatting">
            <treat :treatData="treatData" @goback="goback"></treat>
        </div>
    </div>
</template>

<script>
import http from "../../../assets/js/http";
import list from "../../../assets/js/list";
import add from "./add";
import treat from "./treat/index";

export default {
  //  currentPage        页码
  //  keywords           关键字
  //  multipleSelection  被选中的数据
  //  limit              每页最大行数
  data() {
    return {
      tableData: [],
      selectData: {},
      dataCount: null,
      currentPage: null,
      keywords: "",
      multipleSelection: [],
      limit: 15,
      add: true,
      setting: false,
      treatting:false,
      selectData: {},
      treatData:{},
    };
  },
  methods: {
    goback(bool) {
      this.setting = bool;
    },
    treat(data){
      this.treatting = true;
      this.treatData = data
    },
    addressSetting() {
      this.add = true;
      this.setting = true;
      var data = {
        name: "",
        sex: "",
        age: "",
        title: "",
        department: ""
      };
      this.selectData = data;
    },
    rowDblclick(row) {
      this.add = false;
      this.setting = true;
      this.selectData = row;
    },
    //获取被选中的数据
    selectItem(val) {
      this.multipleSelection = val;
    },
    //删除按钮事件
    deleteBtn() {
      var vm = this;
      this.$confirm("Are you sure to delete the selected data?", "Tips", {
        confirmButtonText: "Yse",
        cancelButtonText: "No",
        type: "warning"
      })
        .then(() => {
          var ids = [];
          for (var selection of vm.multipleSelection) {
            ids.push(selection.Id);
          }
          const data = {
            params: {
              ids: ids
            }
          };
          this.apiPost("admin/record/deletes", data).then(res => {
            if (res[0]) {
              this.getAllData();
              _g.toastMsg("success", res[1]);
            } else {
              _g.toastMsg("error", res[1]);
            }
          });
        })
        .catch(() => {
          // catch error
        });
    },
    getAllData() {
      const data = {
        params: {
          keywords: this.keywords,
          page: this.currentPage,
          limit: this.limit
        }
      };
      this.apiGet("admin/doctor", data).then(res => {
        if (res.code == 200) {
          this.tableData = res.data.list;
          this.dataCount = res.data.dataCount;
          // this.$store.dispatch("setAddress", address);
          // _g.toastMsg("success", res[1]);
        } else {
          // _g.toastMsg("error", res[1]);
        }
      });
    },
    //初始化时统一加载
    init() {
      this.getKeywords();
      this.getCurrentPage();
      this.getAllData();
    }
  },
  created() {
    console.log("doctor");
    this.init();
  },
  components: {
    add,
    treat,
  },
  computed: {},
  watch: {
    $route(to, from) {
      this.init();
    }
  },
  mixins: [http, list]
};
</script>