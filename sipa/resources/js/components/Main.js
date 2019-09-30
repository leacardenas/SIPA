import React,{Component} from 'react';

import MainLogin from './MainLogin'
import Titulo from './Titulo'

export default class Main extends Component{
    constructor(){
        super()
    }


    render(){
        return <div>
                <Titulo title = {"Accede a tu cuenta"}/>
                <MainLogin/>
            </div>

           
    }
}

if (document.getElementById('main')) {
    ReactDOM.render(<Main/>, document.getElementById('main'));
}