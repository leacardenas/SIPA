import React,{Component} from 'react';

import Inicio from './inicio'
import Title from './title'

class Main extends Component{
    constructor(){
        super()
    }


    render(){
        return <div>
                <Title title = {"Accede a tu cuenta"}/>
                <Inicio/> {/*Incompleto */}
            </div>

           
    }
}

export default Principal