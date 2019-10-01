import React from 'react';
import FormularioLogin from './FormularioLogin';

const FormularioRegistro = () => (

    <form /*onSubmit={this.obtieneClaveUsuario}*/>
    <div>
        <label htmlFor ="usuario" className = "labelUsuarioRegistro">Usuario</label>
        <input type = "text"  name="usuario" className = "inputUsuarioRegistro"/>
    </div>
    <div>
        <label htmlFor ="nomFuncionaro" className = "labelFuncionarioRegistro">Nombre de Funcionario</label>
        <input type = "text"name="funcionario" className = "inputFuncionarioRegistro"/>
    </div>
    <div>
        <label htmlFor = "correo" className= "labelCorreoRegistro">Correo Electrónico</label>
        <input type = "text" placeholder="Ingrese su correo electrónico" name ="correo" className= "inputCorreoRegistro" />
    </div>
    <div>
        <label htmlFor = "telefono" className= "labelTelefRegistro">Teléfono</label>
        <input type = "text" placeholder="Ingrese su número de teléfono" name = "numeroTelefono" className= "inputTelefRegistro"/>
    </div>
    <label className='labelEdificioRegistro'> Edificio</label>
    <select className = "edificioBox">
        <option value="opcion1">Edificio 1</option>
        <option value="opcion2">Edificio 2</option>
    </select>
    <label className='labelPisoRegistro'> Piso</label>
    <select className = "pisoBox">
        <option value="opcion1">Piso 1</option>
        <option value="opcion2">Piso 2</option>
    </select>
    <label className='labelUnidadRegistro'> Unidad</label>
    <select className = "unidadBox">
        <option value="opcion1">Unidad 1</option>
        <option value="opcion2">Unidad 2</option>
    </select>
    <button className='registrarse'>Registrarse</button>
</form>
)

export default FormularioRegistro
   
   
  