
var app = new Vue({
    el  : '#app',
    data:{
        experiences: [],
        formations : [],
        projects   : [],
        skills     : [],
        open       : {
        	experiences: false,
        	formations : false,
        	skills     : false,
        	projects   : false,
        },
        edit : {
        	experiences: false,
        	formations : false,
        	skills     : false,
        	projects   : false,
        },

        formation : {
            id    : 0,
            cv_id : window.Laravel.idCv,
            title : '',
            description  : '',
            start : '',
            end   : '',
        },
        experience : {
            id    : 0,
            cv_id : window.Laravel.idCv,
            title : '',
            description  : '',
            start : '',
            end   : '',
        },
        project : {
            id      : 0,
            cv_id   : window.Laravel.idCv,
            title   : '',
            description  : '',
            link    : '',
            image   : '',
        },
        skill : {
            id           : 0,
            cv_id        : window.Laravel.idCv,
            title        : '',
            percentage   : '',
        },
    },
    methods: {
        getData: function() {
            axios.get(window.Laravel.url+'/getData/'+window.Laravel.idCv)
            .then(response => {
                this.formations = response.data.formations;
                this.experiences = response.data.experiences;
                this.projects = response.data.projects;
                this.skills = response.data.skills;
            })
            .catch(error => {
                console.log('error: ', error);
            })
        },
        // ***************************************************************************************
        cancelFormation: function(){
            this.open.formations= false;
        },
        addFormation: function(){
            axios.post(window.Laravel.url+'/addFormation', this.formation)
            .then(response => {
                if(response.data.status){
                    this.open.formations = false;
                    //this.formations.push(this.formation); //push add element in the end of list
                    this.formation.id = response.data.id;
                    this.formations.unshift(this.formation); //unshift add element in the top of list
                    // to clear data from form
                    this.formation= {
                        id    : 0,
                        cv_id : window.Laravel.idCv,
                        title : '',
                        description  : '',
                        start : '',
                        end   : '',
                    };
                }
            })
            .catch(error => {
                console.log('error: ', error)
            })
        },
        editFormation: function(formation){
            this.open.formations= true;
            this.edit.formations= true; 
            this.formation = formation // pour passer l formation a editer a l objet formation avec lequel on fait data-binding et pour que le formulaire soit rempli avec les données de l'exp a editer                   
        },
        updateFormation: function(){
            axios.put(window.Laravel.url+'/updateFormation', this.formation)
            .then(response => {
                if(response.data.status){
                    this.open.formations = false;
                    // to clear data from form
                    this.formation= {
                        id    : 0,
                        cv_id : window.Laravel.idCv,
                        title : '',
                        description  : '',
                        start : '',
                        end   : '',
                    };
                    this.edit= false;
                }
            })
            .catch(error => {
                console.log('error: ', error)
            })
        },
        deleteFormation: function(formation){
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then( ()=> {
                axios.delete(window.Laravel.url+'/deleteFormation/'+formation.id)
                .then(response => {
                    if(response.data.status){
                        var position= this.formations.indexOf(formation);
                        this.formations.splice(position, 1);
                    }
                })
                .catch(error => {
                    console.log('error: ', error)
                })
                swal(
                    'Deleted!',
                    'Your formation has been deleted.',
                    'success'
                )
            })
        },
        //***********************************************************************************
        cancelExperience: function(){
            this.open.experiences= false;
        },
        addExperience: function(){
            axios.post(window.Laravel.url+'/addExperience', this.experience)
            .then(response => {
                if(response.data.status){
                    this.open.experiences = false;
                    //this.experiences.push(this.experience); //push add element in the end of list
                    this.experience.id = response.data.id;
                    this.experiences.unshift(this.experience); //unshift add element in the top of list
                    // to clear data from form
                    this.experience= {
                        id    : 0,
                        cv_id : window.Laravel.idCv,
                        title : '',
                        description  : '',
                        start : '',
                        end   : '',
                    };
                }
            })
            .catch(error => {
                console.log('error: ', error)
            })
        },
        editExperience: function(experience){
            this.open.experiences= true;
            this.edit.experiences= true; 
            this.experience = experience // pour passer l experience a editer a l objet experience avec lequel on fait data-binding et pour que le formulaire soit rempli avec les données de l'exp a editer                   
        },
        updateExperience: function(){
            axios.put(window.Laravel.url+'/updateExperience', this.experience)
            .then(response => {
                if(response.data.status){
                    this.open.experiences = false;
                    // to clear data from form
                    this.experience= {
                        id    : 0,
                        cv_id : window.Laravel.idCv,
                        title : '',
                        description  : '',
                        start : '',
                        end   : '',
                    };
                    this.edit= false;
                }
            })
            .catch(error => {
                console.log('error: ', error)
            })
        },
        deleteExperience: function(experience){
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then( ()=> {
                axios.delete(window.Laravel.url+'/deleteExperience/'+experience.id)
                .then(response => {
                    if(response.data.status){
                        var position= this.experiences.indexOf(experience);
                        this.experiences.splice(position, 1);
                    }
                })
                .catch(error => {
                    console.log('error: ', error)
                })
                swal(
                    'Deleted!',
                    'Your experience has been deleted.',
                    'success'
                )
            })
        },
        //***********************************************************************************
        cancelProject: function(){
            this.open.projects= false;
        },
        addProject: function(){
            axios.post(window.Laravel.url+'/addProject', this.project)
            .then(response => {
                if(response.data.status){
                    this.open.projects = false;
                    //this.projects.push(this.project); //push add element in the end of list
                    this.project.id = response.data.id;
                    this.projects.unshift(this.project); //unshift add element in the top of list
                    // to clear data from form
                    this.project= {
                        id    : 0,
                        cv_id : window.Laravel.idCv,
                        title : '',
                        description: '',
                        link    : '',
                        image   : '',
                    };
                }
            })
            .catch(error => {
                console.log('error: ', error)
            })
        },
        editProject: function(project){
            this.open.projects= true;
            this.edit.projects= true; 
            this.project = project // pour passer l project a editer a l objet project avec lequel on fait data-binding et pour que le formulaire soit rempli avec les données de l'exp a editer                   
        },
        updateProject: function(){
            axios.put(window.Laravel.url+'/updateProject', this.project)
            .then(response => {
                if(response.data.status){
                    this.open.projects = false;
                    // to clear data from form
                    this.project= {
                        id    : 0,
                        cv_id : window.Laravel.idCv,
                        title : '',
                        description: '',
                        link    : '',
                        image   : '',
                    };
                    this.edit.projects= false;
                }
            })
            .catch(error => {
                console.log('error: ', error)
            })
        },
        deleteProject: function(project){
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then( ()=> {
                axios.delete(window.Laravel.url+'/deleteProject/'+project.id)
                .then(response => {
                    if(response.data.status){
                        var position= this.projects.indexOf(project);
                        this.projects.splice(position, 1);
                    }
                })
                .catch(error => {
                    console.log('error: ', error)
                })
                swal(
                    'Deleted!',
                    'Your project has been deleted.',
                    'success'
                )
            })
        },
        //***********************************************************************************
        cancelSkill: function(){
            this.open.skills= false;
        },
        addSkill: function(){
            axios.post(window.Laravel.url+'/addSkill', this.skill)
            .then(response => {
                if(response.data.status){
                    this.open.skills = false;
                    //this.skills.push(this.skill); //push add element in the end of list
                    this.skill.id = response.data.id;
                    this.skills.unshift(this.skill); //unshift add element in the top of list
                    // to clear data from form
                    this.skill= {
                        id    : 0,
                        cv_id : window.Laravel.idCv,
                        title : '',
                        percentage   : '',
                    };
                }
            })
            .catch(error => {
                console.log('error: ', error)
            })
        },
        editSkill: function(skill){
            this.open.skills= true;
            this.edit.skills= true; 
            this.skill = skill // pour passer l skill a editer a l objet skill avec lequel on fait data-binding et pour que le formulaire soit rempli avec les données de l'exp a editer                   
        },
        updateSkill: function(){
            axios.put(window.Laravel.url+'/updateSkill', this.skill)
            .then(response => {
                if(response.data.status){
                    this.open.skills = false;
                    // to clear data from form
                    this.skill= {
                        id    : 0,
                        cv_id : window.Laravel.idCv,
                        title : '',
                        percentage   : '',
                    };
                    this.edit.skills= false;
                }
            })
            .catch(error => {
                console.log('error: ', error)
            })
        },
        deleteSkill: function(skill){
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then( ()=> {
                axios.delete(window.Laravel.url+'/deleteSkill/'+skill.id)
                .then(response => {
                    if(response.data.status){
                        var position= this.skills.indexOf(skill);
                        this.skills.splice(position, 1);
                    }
                })
                .catch(error => {
                    console.log('error: ', error)
                })
                swal(
                    'Deleted!',
                    'Your skill has been deleted.',
                    'success'
                )
            })
        },
        //***********************************************************************************
        validateForm(scope) {
            this.$validator.validateAll(scope).then((result) => {
                if (result) {
                    this.addFormation();
                }
            });
        }

    },
    mounted: function(){
        this.getData();
    }
});