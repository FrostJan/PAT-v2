import { Button } from '@/components/ui/button';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Calendar', href: '/dashboard' },
    { title: 'Document History', href: '/document-history' },
];

interface HistoryRow {
    id: number;
    department: string;
    activity_purpose: string | null;
    date_needed: string | null;
    time_needed_start: string | null;
    time_needed_end: string | null;
    person_in_charge: string;
    contact_number: string;
    user: string | null;
    attachment_url: string | null;
    attachment_name: string | null;
}

interface Props {
    requests: HistoryRow[];
}

export default function DocumentHistoryIndex({ requests }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Document History" />
            <div className="flex h-full flex-1 flex-col gap-4 p-4">
                <h1 className="text-2xl font-bold tracking-tight">Document history</h1>

                <div className="rounded-xl border bg-background">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Department</TableHead>
                                <TableHead>Activity</TableHead>
                                <TableHead>Date needed</TableHead>
                                <TableHead>Time</TableHead>
                                <TableHead>Person in-charge</TableHead>
                                <TableHead>File</TableHead>
                                <TableHead className="text-right">Actions</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {requests.length === 0 && (
                                <TableRow>
                                    <TableCell colSpan={7} className="text-center text-muted-foreground">
                                        No approved documents yet.
                                    </TableCell>
                                </TableRow>
                            )}
                            {requests.map((r) => (
                                <TableRow key={r.id}>
                                    <TableCell className="font-medium">{r.department}</TableCell>
                                    <TableCell>{r.activity_purpose}</TableCell>
                                    <TableCell>{r.date_needed}</TableCell>
                                    <TableCell>
                                        {r.time_needed_start} – {r.time_needed_end}
                                    </TableCell>
                                    <TableCell>
                                        <div>{r.person_in_charge}</div>
                                        <div className="text-xs text-muted-foreground">{r.contact_number}</div>
                                    </TableCell>
                                    <TableCell>
                                        {r.attachment_url ? (
                                            <a
                                                className="text-sm text-blue-600 underline"
                                                href={r.attachment_url}
                                                target="_blank"
                                                rel="noreferrer noopener"
                                            >
                                                {r.attachment_name}
                                            </a>
                                        ) : (
                                            <span className="text-muted-foreground">—</span>
                                        )}
                                    </TableCell>
                                    <TableCell className="text-right">
                                        <Button asChild size="sm" variant="outline">
                                            <Link href={`/requests/${r.id}`}>Details</Link>
                                        </Button>
                                    </TableCell>
                                </TableRow>
                            ))}
                        </TableBody>
                    </Table>
                </div>
            </div>
        </AppLayout>
    );
}
