import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Calendar', href: '/dashboard' },
    { title: 'Log', href: '/log' },
];

interface AuditRow {
    id: number;
    event: string;
    user: { name: string; email: string } | null;
    subject_type: string | null;
    subject_id: number | null;
    meta: Record<string, unknown> | null;
    ip: string | null;
    created_at: string;
}

interface Props {
    logs: AuditRow[];
}

export default function LogIndex({ logs }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Log" />
            <div className="flex h-full flex-1 flex-col gap-4 p-4">
                <h1 className="text-2xl font-bold tracking-tight">Audit log</h1>
                <div className="rounded-xl border bg-background">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Time</TableHead>
                                <TableHead>User</TableHead>
                                <TableHead>Event</TableHead>
                                <TableHead>Subject</TableHead>
                                <TableHead>Meta</TableHead>
                                <TableHead>IP</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {logs.map((l) => (
                                <TableRow key={l.id}>
                                    <TableCell className="whitespace-nowrap">{new Date(l.created_at).toLocaleString()}</TableCell>
                                    <TableCell>{l.user?.name ?? 'system'}</TableCell>
                                    <TableCell>{l.event}</TableCell>
                                    <TableCell>
                                        {l.subject_type ? `${l.subject_type.split('\\').pop()}#${l.subject_id}` : '-'}
                                    </TableCell>
                                    <TableCell>
                                        <code className="text-xs">{l.meta ? JSON.stringify(l.meta) : '-'}</code>
                                    </TableCell>
                                    <TableCell>{l.ip ?? '-'}</TableCell>
                                </TableRow>
                            ))}
                        </TableBody>
                    </Table>
                </div>
            </div>
        </AppLayout>
    );
}
