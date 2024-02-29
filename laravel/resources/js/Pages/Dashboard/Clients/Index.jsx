import NavLink from "@/Components/NavLink";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";

export default function Clients({ auth, clients }) {
    return (
        <AuthenticatedLayout user={auth.user}
            header={
                <div className="flex justify-between">
                    <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Listagem de Clientes</h2>
                    <NavLink href={route('dashboard.clients.create')}>
                        Novo Cliente
                    </NavLink>
                </div>
            }
        >
            <Head title="Clients" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <table className="w-full table-auto text-gray-900 dark:text-gray-200">
                            <thead>
                                <tr>
                                    <th className="text-start py-4 px-10 border-b border-slate-600 bg-red-900">Nome</th>
                                    <th className="text-start border-b border-slate-600 bg-red-900">Telefone</th>
                                    <th className="text-start border-b border-slate-600 bg-red-900">Email</th>
                                    <th className="text-start border-b border-slate-600 bg-red-900">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                {clients.length > 0 ? clients.map((client, i) => (
                                    <tr key={i}>
                                        <td className="py-4 px-10">{client.name}</td>
                                        <td>{client.phone_number}</td>
                                        <td>{client.email}</td>
                                        <td><NavLink href={route("dashboard.clients.show", client.id)}>Visualizar</NavLink></td>
                                    </tr>
                                )) : (
                                <tr>
                                    <td className="py-4 px-10">Nenhum item registrado!</td>
                                    <td></td>
                                    <td></td>
                                </tr>)
                            }
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    )
}