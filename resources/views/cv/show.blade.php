@extends('layouts.app')

@section('content')
<div class="container" id="app">
    <div class="row"> 
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-10"><h3 class="panel-title"> Formation </h3></div>
                        <div class="col-md-2">
                            <button class="btn btn-success pull-right" @click="open.formations = true"><i class="fa fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form @submit.prevent="validateForm('formation-scope')" data-vv-scope="formation-scope">
                        <div class="form" v-if="open.formations">
                            <div :class="{'form-group': true, 'has-error': errors.first('formation-scope.title')}">
                                <input type="text" name="title" class="form-control" placeholder="Title of Formation" v-model="formation.title" v-validate="'required'">
                                <label v-show="errors.has('formation-scope.title')" class="control-label">@{{ errors.first('formation-scope.title') }}</label>
                            </div>
                            <div :class="{'form-group': true, 'has-error': errors.first('formation-scope.description')}">
                                <textarea name="description" id="description" class="form-control" placeholder="Description" v-model="formation.description" v-validate="'required'"></textarea>
                                <label v-show="errors.has('formation-scope.description')" class="control-label">@{{ errors.first('formation-scope.description') }}</label>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div :class="{'col-md-6': true, 'has-error': errors.first('formation-scope.start')}">
                                        <input type="date" placeholder="Start date" class="form-control" name="start" id="start" v-model="formation.start" v-validate="'required'">
                                        <label v-show="errors.has('formation-scope.start')" class="control-label">@{{ errors.first('formation-scope.start') }}</label>
                                    </div>
                                    <div :class="{'col-md-6': true, 'has-error': errors.first('formation-scope.end')}">
                                        <input type="date" placeholder="End date" class="form-control" name="end" id="end" v-model="formation.end" v-validate="'required|confirmed:start'">
                                        <label v-show="errors.has('formation-scope.end')" class="control-label">@{{ errors.first('formation-scope.end') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button v-if="edit.formations" class="btn btn-success" @click="updateFormation" >update formation</button> 
                                <button v-else class="btn btn-success" type="submit" @click="">Add formation</button>
                                <button class="btn btn-default" @click="cancelFormation">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <ul class="list-unstyled">
                        <li class="" v-for="formation in formations">
                            <div class="pull-right">
                                <button class="btn btn-danger btn-sm pull-right" @click="deleteFormation(formation)"><i class="fa fa-edit"></i> Delete</button>
                                <button class="btn btn-default btn-sm pull-right" @click="editFormation(formation)"><i class="fa fa-edit"></i> Edit</button>
                            </div>
                            <h3> @{{formation.title}} </h3>
                            <p> @{{formation.description}} </p>
                            <p> @{{formation.start}} - @{{formation.end}}</p>
                            <hr>
                        </li>
                    </ul>
                    
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-10"><h3 class="panel-title"> Expériences </h3></div>
                        <div class="col-md-2">
                            <button class="btn btn-success pull-right" @click="open.experiences = true"><i class="fa fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form" v-if="open.experiences">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Title of experence" v-model="experience.title">
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="description" class="form-control" placeholder="Description" v-model="experience.description"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" placeholder="Start date" class="form-control" name="start" id="start" v-model="experience.start">
                                </div>
                                <div class="col-md-6">
                                    <input type="date" placeholder="End date" class="form-control" name="end" id="end" v-model="experience.end">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button v-if="edit.experiences" class="btn btn-success" @click="updateExperience" >update experience</button> 
                            <button v-else class="btn btn-success" @click="addExperience">Add experience</button>
                            <button class="btn btn-default" @click="cancelExperience">Cancel</button>
                        </div>
                    </div>
                    <ul class="list-unstyled">
                        <li class="" v-for="experience in experiences">
                            <div class="pull-right">
                                <button class="btn btn-danger btn-sm pull-right" @click="deleteExperience(experience)"><i class="fa fa-edit"></i> Delete</button>
                                <button class="btn btn-default btn-sm pull-right" @click="editExperience(experience)"><i class="fa fa-edit"></i> Edit</button>
                            </div>
                            <h3> @{{experience.title}} </h3>
                            <p> @{{experience.description}} </p>
                            <p> @{{experience.start}} - @{{experience.end}}</p>
                            <hr>
                        </li>
                    </ul>
                    
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-10"><h3 class="panel-title"> Projects </h3></div>
                        <div class="col-md-2">
                            <button class="btn btn-success pull-right" @click="open.projects = true"><i class="fa fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form" v-if="open.projects">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Title of project" v-model="project.title">
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="description" class="form-control" placeholder="Description" v-model="project.description"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" placeholder="Link" class="form-control" name="link" id="link" v-model="project.link">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="image" class="form-control" name="image" id="image" v-model="project.image">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button v-if="edit.projects" class="btn btn-success" @click="updateProject" >update project</button> 
                            <button v-else class="btn btn-success" @click="addProject">Add project</button>
                            <button class="btn btn-default" @click="cancelProject">Cancel</button>
                        </div>
                    </div>
                    <ul class="list-unstyled">
                        <li class="" v-for="project in projects">
                            <div class="pull-right">
                                <button class="btn btn-danger btn-sm pull-right" @click="deleteProject(project)"><i class="fa fa-edit"></i> Delete</button>
                                <button class="btn btn-default btn-sm pull-right" @click="editProject(project)"><i class="fa fa-edit"></i> Edit</button>
                            </div>
                            <h3> @{{project.title}} </h3>
                            <p> @{{project.description}} </p>
                            <p> @{{project.link}} - @{{project.image}}</p>
                            <hr>
                        </li>
                    </ul>
                    
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-10"><h3 class="panel-title"> Skills </h3></div>
                        <div class="col-md-2">
                            <button class="btn btn-success pull-right" @click="open.skills = true"><i class="fa fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form" v-if="open.skills">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Title of skill " v-model="skill.title">
                        </div>
                        <div class="form-group">
                            <input type="number" placeholder="Percentage" class="form-control" name="percentage" id="percentage" v-model="skill.percentage">
                        </div>
                        <div class="form-group">
                            <button v-if="edit.skills" class="btn btn-success" @click="updateSkill" >update skill</button> 
                            <button v-else class="btn btn-success" @click="addSkill">Add skill</button>
                            <button class="btn btn-default" @click="cancelSkill">Cancel</button>
                        </div>
                    </div>
                    <ul class="list-unstyled">
                        <li class="" v-for="skill in skills">
                            <div class="pull-right">
                                <button class="btn btn-danger btn-sm pull-right" @click="deleteSkill(skill)"><i class="fa fa-edit"></i> Delete</button>
                                <button class="btn btn-default btn-sm pull-right" @click="editSkill(skill)"><i class="fa fa-edit"></i> Edit</button>
                            </div>
                            <span class="h2"> @{{skill.title}} </span > <span> @{{skill.percentage}} % </span>
                            <hr>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script>
        Vue.use(VeeValidate); // to trigger vee validate 
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'idCv'     => $id,
            'url'       => url('/'),
        ]) !!};
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection