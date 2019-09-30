import React,{Component} from 'react';

import MainLogin from './MainLogin'
import Titulo from './Titulo'

class Main extends Component{
    constructor(){
        super()
    }


    render(){
        return <div>
                <Title title = {"Accede a tu cuenta"}/>
                <MainLogin/> {/*Incompleto */}
            </div>

           
    }
}

export default Principal