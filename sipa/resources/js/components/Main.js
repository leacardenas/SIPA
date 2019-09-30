import React,{Component} from 'react';

import MainLogin from './MainLogin'
import Titulo from './Titulo'

class Main extends Component{
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

export default Main