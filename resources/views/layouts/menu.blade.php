<!-- need to remove -->
<style>
    [class*=sidebar-dark-] .nav-sidebar>.nav-item1.menu-open>.nav-link,
    [class*=sidebar-dark-] .nav-sidebar>.nav-item1>.nav-link:focus {
        background-color: #0b195261;
        color: #ffffff;
    }

</style>
@if (auth()->user()->role->name == 'Administrator')
    <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link active">
            <i class="nav-icon fas fa-home"></i>
            <p>Home</p>
        </a>
    </li>


    <li class="nav-item has-treeview  @if(url()->current()==route('users.index') || url()->current()==route('users.create')) menu-open @endif">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Users
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon @if(url()->current()==route('users.index')) far fa-dot-circle  red @endif" ></i>
                    <p>List</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon @if(url()->current()==route('users.create')) far fa-dot-circle  red @endif"></i>
                    <p>Create</p>
                </a>
            </li>

        </ul>
    </li>
    <li class="nav-item has-treeview @if(url()->current()==route('agencies.index') || url()->current()==route('agencies.create')) menu-open @endif">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
                Agency
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('agencies.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon @if(url()->current()==route('agencies.index')) far fa-dot-circle  red @endif"></i>
                    <p>List</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('agencies.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon @if(url()->current()==route('agencies.create')) far fa-dot-circle  red @endif"></i>
                    <p>Create</p>
                </a>
            </li>

        </ul>
    </li>
    <li class="nav-item has-treeview ">
        <a href="#" class="nav-link">
            <i class="nav-icon fa fa-list"></i>
            <p>
                Realtors
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview" @if(url()->current()== route('agents.index') ||url()->current()== route('agents.create') || url()->current()== route('agentspecialities.index') || url()->current()== route('agentspecialities.create') || url()->current()== route('agentareas.index') || url()->current()== route('agentareas.create') )   style="display: block;" @else style="display: none;" @endif >
            <li class="nav-item has-treeview @if(url()->current()==route('agents.index') || url()->current()==route('agents.create')) menu-open @endif" >
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        Realtor All
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('agents.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon @if(url()->current()==route('agents.index')) far fa-dot-circle  red @endif"></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('agents.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon @if(url()->current()==route('agents.create')) far fa-dot-circle  red @endif" ></i>
                            <p>Create</p>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item has-treeview @if(url()->current()==route('agentspecialities.index') || url()->current()==route('agentspecialities.create')) menu-open @endif">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>

                        Realtor Specialities
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('agentspecialities.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon @if(url()->current()==route('agentspecialities.index')) far fa-dot-circle  red @endif"></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('agentspecialities.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon @if(url()->current()==route('agentspecialities.create')) far fa-dot-circle  red @endif"></i>
                            <p>Create</p>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item has-treeview @if(url()->current()==route('agentareas.index') || url()->current()==route('agentareas.create')) menu-open @endif">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        Realtor Areas
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('agentareas.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon @if(url()->current()==route('agentareas.index')) far fa-dot-circle  red @endif" ></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('agentareas.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon @if(url()->current()==route('agentareas.create')) far fa-dot-circle  red @endif"></i>
                            <p>Create</p>
                        </a>
                    </li>

                </ul>
            </li>



        </ul>
    </li>




    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
                Areas
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview" @if(url()->current()== route('areaones.index') || url()->current()== route('areaones.create') || url()->current()== route('areatwos.index') ||  url()->current()== route('areatwos.create') || url()->current()== route('areathrees.index') || url()->current()== route('areathrees.create') )   style="display: block;" @else style="display: none;" @endif >
            <li class="nav-item has-treeview @if(url()->current()==route('areaones.index') || url()->current()==route('areaones.create')) menu-open @endif" >
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        Area One
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('areaones.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon @if(url()->current()==route('areaones.index')) far fa-dot-circle  red @endif"></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('areaones.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon @if(url()->current()==route('areaones.create')) far fa-dot-circle  red @endif"></i>
                            <p>Create</p>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item has-treeview @if(url()->current()==route('areatwos.index') || url()->current()==route('areatwos.create'))   menu-open @endif">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        Area Two
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('areatwos.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon @if(url()->current()==route('areatwos.index')) far fa-dot-circle  red @endif"></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('areatwos.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon @if(url()->current()==route('areatwos.create')) far fa-dot-circle  red @endif"></i>
                            <p>Create</p>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item has-treeview  @if(url()->current()==route('areathrees.index') || url()->current()==route('areathrees.create'))  menu-open @endif ">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        Area Three
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('areathrees.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon @if(url()->current()==route('areathrees.index')) far fa-dot-circle  red @endif"></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('areathrees.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon @if(url()->current()==route('areathrees.create')) far fa-dot-circle  red @endif"></i>
                            <p>Create</p>
                        </a>
                    </li>

                </ul>
            </li>



        </ul>
    </li>

    <li class="nav-item has-treeview @if(url()->current()==route('cities.index') || url()->current()==route('cities.create')) menu-open @endif">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
                Cities
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('cities.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon @if(url()->current()==route('cities.index')) far fa-dot-circle  red @endif"></i>
                    <p>List</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('cities.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon @if(url()->current()==route('cities.create')) far fa-dot-circle  red @endif"></i>
                    <p>Create</p>
                </a>
            </li>

        </ul>
    </li>
@endif

<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-list"></i>
        <p>
            Leads
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview" @if(url()->current()==route('leads.completedleads') || url()->current()== route('leads.index') || url()->current()== route('leads.create') || url()->current()== route('leadassigns.index')  ||  url()->current()== route('leadassigns.create') || url()->current()== route('leadprojects.index') ||  url()->current()== route('leadprojects.create') ||url()->current()== route('leadproperties.index') ||url()->current()== route('leadproperties.create')  )   style="display: block;" @else style="display: none;" @endif>
        <li class="nav-item has-treeview @if(url()->current()==route('leads.index'))   menu-open @endif">
            <a href="#" class="nav-link">
                <i class="nav-icon fas  fa-user-check"></i>
                <p>
                    Lead All
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('leads.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('leads.index')) far fa-dot-circle  red @endif"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('leads.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('leads.create')) far fa-dot-circle  red @endif"></i>
                        <p>Create</p>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item has-treeview @if(url()->current()==route('leads.completedleads'))   menu-open @endif">
            <a href="#" class="nav-link">
                <i class="nav-icon fas  fa-user-check"></i>
                <p>
                    Completed Leads
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('leads.completedleads') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('leads.completedleads')) far fa-dot-circle  red @endif"></i>
                        <p>List</p>
                    </a>
                </li>


            </ul>
        </li>
        @if (auth()->user()->role->name == 'Administrator')
            <li class="nav-item has-treeview @if(url()->current()==route('leadassigns.index') || url()->current()==route('leadassigns.create')) menu-open @endif">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-building"></i>
                    <p>
                        Lead Assign
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('leadassigns.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon @if(url()->current()==route('leadassigns.index')) far fa-dot-circle  red @endif"></i>
                            <p>List</p>
                        </a>
                    </li>


                </ul>
            </li>
        @endif
        <li class="nav-item has-treeview @if(url()->current()==route('leadprojects.index') || url()->current()==route('leadprojects.create')) menu-open @endif">
            <a href="#" class="nav-link">
                <i class="nav-icon  far fa-building"></i>
                <p>
                    Lead Projects
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('leadprojects.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('leadprojects.index')) far fa-dot-circle  red @endif"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('leadprojects.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('leadprojects.create')) far fa-dot-circle  red @endif"></i>
                        <p>Create</p>
                    </a>
                </li>

            </ul>
        </li>
        @if (auth()->user()->role->name == 'Administrator')
            <li class="nav-item has-treeview @if(url()->current()==route('leadproperties.index') || url()->current()==route('leadproperties.create')) menu-open @endif">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas  fa-user-check"></i>
                    <p>
                        Lead Properties
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('leadproperties.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon @if(url()->current()==route('leadproperties.index')) far fa-dot-circle  red @endif"></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('leadproperties.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon @if(url()->current()==route('leadproperties.create')) far fa-dot-circle  red @endif"></i>
                            <p>Create</p>
                        </a>
                    </li>

                </ul>
            </li>


    </ul>
</li>


<li class="nav-item has-treeview nav-item1">
    <a href="#" class="nav-link">
        <i class="nav-icon  fa fa-wrench"></i>
        <p>
            Project
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" @if(url()->current()== route('projects.index') || url()->current()== route('projects.create') || url()->current()== route('projectbuyers.index') || url()->current()== route('projectbuyers.create') || url()->current()== route('projectshops.index') || url()->current()== route('projectshops.create') || url()->current()== route('projectsales.index') || url()->current()== route('projectsales.create') || url()->current()== route('projectsalesinstallments.index') || url()->current()== route('projectsalesinstallments.create') )   style="display: block;" @else style="display: none;" @endif>

        <li class="nav-item has-treeview @if(url()->current()==route('projects.index') || url()->current()==route('projects.create')) menu-open @endif">
            <a href="#" class="nav-link">
                <i class="nav-icon fas  fa-user-check"></i>
                <p>
                    All Projects
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('projects.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('projects.index')) far fa-dot-circle  red @endif"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('projects.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('projects.create')) far fa-dot-circle  red @endif"></i>
                        <p>Create</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview @if(url()->current()==route('projectbuyers.index') || url()->current()==route('projectbuyers.create')) menu-open @endif">
            <a href="#" class="nav-link">
                <i class="nav-icon fas  fa-user-check"></i>
                <p>
                    Project Buyers
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('projectbuyers.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('projectbuyers.index')) far fa-dot-circle  red @endif"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('projectbuyers.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('projectbuyers.create')) far fa-dot-circle  red @endif"></i>
                        <p>Create</p>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item has-treeview @if(url()->current()==route('projectshops.index') || url()->current()==route('projectshops.create')) menu-open @endif">
            <a href="#" class="nav-link">
                <i class="nav-icon fas  fa-user-check"></i>
                <p>
                    Project Shops
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('projectshops.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('projectshops.index')) far fa-dot-circle  red @endif"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('projectshops.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('projectshops.create')) far fa-dot-circle  red @endif"></i>
                        <p>Create</p>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item has-treeview @if(url()->current()==route('projectsales.index') || url()->current()==route('projectsales.create')) menu-open @endif">
            <a href="#" class="nav-link">
                <i class="nav-icon fas  fa-user-check"></i>
                <p>
                    Project Sales
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('projectsales.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('projectsales.index')) far fa-dot-circle  red @endif"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('projectsales.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('projectsales.create')) far fa-dot-circle  red @endif"></i>
                        <p>Create</p>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item has-treeview @if(url()->current()==route('projectsalesinstallments.index') || url()->current()==route('projectsalesinstallments.create')) menu-open @endif">
            <a href="#" class="nav-link">
                <i class="nav-icon fas  fa-user-check"></i>
                <p>
                    Project Installments
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('projectsalesinstallments.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('projectsalesinstallments.index')) far fa-dot-circle  red @endif"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('projectsalesinstallments.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('projectsalesinstallments.create')) far fa-dot-circle  red @endif"></i>
                        <p>Create</p>
                    </a>
                </li>

            </ul>
        </li>






    </ul>
</li>
<li class="nav-item has-treeview @if(url()->current()==route('projectusers.index') || url()->current()==route('projectusers.create')) menu-open @endif">
    <a href="#" class="nav-link">
        <i class="nav-icon fas  fa-user-check"></i>
        <p>
            Project Users
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('projectusers.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon @if(url()->current()==route('projectusers.index')) far fa-dot-circle  red @endif"></i>
                <p>List</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('projectusers.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon @if(url()->current()==route('projectusers.create')) far fa-dot-circle  red @endif"></i>
                <p>Create</p>
            </a>
        </li>

    </ul>
</li>

<li class="nav-item has-treeview @if(url()->current()==route('properties.index') || url()->current()==route('properties.create') || url()->current()==route('properties.by_parent')) menu-open @endif ">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-rocket"></i>
        <p>
            Properties
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
            <a href="{{ route('properties.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon @if(url()->current()==route('properties.index')) far fa-dot-circle  red @endif"></i>
                <p>List</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('properties.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon @if(url()->current()==route('properties.create')) far fa-dot-circle  red @endif"></i>
                <p>Create</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('properties.by_parent') }}" class="nav-link">
                <i class="far fa-circle nav-icon @if(url()->current()==route('properties.by_parent')) fa  red @endif"></i>
                <p>By Parent</p>
            </a>
        </li>

    </ul>
</li>

<li class="nav-item has-treeview @if(url()->current()==route('propertysocials.index') || url()->current()==route('propertysocials.create')) menu-open @endif">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-info"></i>
        <p>
            Property Social
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('propertysocials.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon @if(url()->current()==route('propertysocials.index')) far fa-dot-circle  red @endif"></i>
                <p>List</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('propertysocials.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon @if(url()->current()==route('propertysocials.create')) far fa-dot-circle  red @endif"></i>
                <p>Create</p>
            </a>
        </li>

    </ul>
</li>
<li class="nav-item has-treeview @if(url()->current()==route('roles.index') || url()->current()==route('roles.create')) menu-open @endif">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-comments"></i>
        <p>
            Roles
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview ">
        <li class="nav-item">
            <a href="{{ route('roles.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon @if(url()->current()==route('roles.index')) far fa-dot-circle  red @endif"></i>
                <p>List</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('roles.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon @if(url()->current()==route('roles.create')) far fa-dot-circle  red @endif"></i>
                <p>Create</p>
            </a>
        </li>


    </ul>
</li>
<li class="nav-item has-treeview @if(url()->current()==route('specialities.index') || url()->current()==route('specialities.create')) menu-open @endif">
    <a href="#" class="nav-link">
        <i class="nav-icon  fa fa-wrench"></i>
        <p>
            Specialities
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('specialities.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon @if(url()->current()==route('specialities.index')) far fa-dot-circle  red @endif"></i>
                <p>List</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('specialities.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon @if(url()->current()==route('specialities.create')) far fa-dot-circle  red @endif"></i>
                <p>Create</p>
            </a>
        </li>

    </ul>
</li>
<li class="nav-item has-treeview @if(url()->current()==route('states.index') || url()->current()==route('states.create')) menu-open @endif">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-store-slash"></i>
        <p>
            States
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('states.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon @if(url()->current()==route('states.index')) far fa-dot-circle  red @endif"></i>
                <p>List</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('states.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon @if(url()->current()==route('states.create')) far fa-dot-circle  red @endif"></i>
                <p>Create</p>
            </a>
        </li>

    </ul>
</li>


<li class="nav-item has-treeview nav-item1">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-cog"></i>
        <p>
            Extra Features
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview"  @if(url()->current()== route('leadsources.index') || url()->current()== route('leadsources.create') || url()->current()== route('callstatus.index') || url()->current()== route('callstatus.create') || url()->current()== route('leadtypes.index') || url()->current()== route('leadtypes.create') || url()->current()== route('responsestatus.index') || url()->current()== route('responsestatus.create') || url()->current()== route('propertytypes.index') ||  url()->current()== route('propertytypes.create') || url()->current()== route('propertyfor.index') || url()->current()== route('propertyfor.create'))   style="display: block;" @else style="display: none;" @endif>
        <li class="nav-item has-treeview  @if(url()->current()==route('leadsources.index') || url()->current()==route('leadsources.create')) menu-open @endif">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Lead Sources
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('leadsources.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('leadsources.index')) far fa-dot-circle  red @endif"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('leadsources.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('leadsources.create')) far fa-dot-circle  red @endif"></i>
                        <p>Create</p>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item has-treeview  @if(url()->current()==route('callstatus.index') || url()->current()==route('callstatus.create')) menu-open @endif">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Call Status
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('callstatus.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('callstatus.index')) far fa-dot-circle  red @endif"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('callstatus.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('callstatus.create')) far fa-dot-circle  red @endif"></i>
                        <p>Create</p>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item has-treeview  @if(url()->current()==route('leadtypes.index') || url()->current()==route('leadtypes.create')) menu-open @endif">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Lead Type
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('leadtypes.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('leadtypes.index')) far fa-dot-circle  red @endif"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('leadtypes.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('leadtypes.create')) far fa-dot-circle  red @endif"></i>
                        <p>Create</p>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item has-treeview  @if(url()->current()==route('responsestatus.index') || url()->current()==route('responsestatus.create')) menu-open @endif">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Response Status
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('responsestatus.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('responsestatus.index')) far fa-dot-circle  red @endif"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('responsestatus.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('responsestatus.create')) far fa-dot-circle  red @endif"></i>
                        <p>Create</p>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item has-treeview  @if(url()->current()==route('propertytypes.index') || url()->current()==route('propertytypes.create')) menu-open @endif" >
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Property Type
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('propertytypes.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('propertytypes.index')) far fa-dot-circle  red @endif"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('propertytypes.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('propertytypes.create')) far fa-dot-circle  red @endif"></i>
                        <p>Create</p>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item has-treeview  @if(url()->current()==route('propertyfor.index') || url()->current()==route('propertyfor.create')) menu-open @endif">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Property For
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('propertyfor.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('propertyfor.index')) far fa-dot-circle  red @endif"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('propertyfor.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon @if(url()->current()==route('propertyfor.create')) far fa-dot-circle  red @endif"></i>
                        <p>Create</p>
                    </a>
                </li>

            </ul>
        </li>

        @endif

    </ul>
</li>
