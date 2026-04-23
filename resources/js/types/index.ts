import { LucideIcon } from 'lucide-react';

export interface Auth {
    user: User | null;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavGroup {
    title: string;
    items: NavItem[];
}

export interface NavItem {
    title: string;
    url: string;
    icon?: LucideIcon | null;
    isActive?: boolean;
    permission?: string;
    role?: string;
}

export interface SharedData {
    name: string;
    auth: Auth;
    flash: {
        status: string | null;
        error: string | null;
    };
    [key: string]: unknown;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar_path: string | null;
    roles: string[];
    permissions: string[];
}

export type RequestStatus = 'pending' | 'approved' | 'declined';

export interface FacilityRequestSummary {
    id: number;
    department: string;
    division?: string;
    activity_purpose: string | null;
    attendees?: number;
    date_filed: string | null;
    date_needed: string | null;
    time_needed_start?: string | null;
    time_needed_end?: string | null;
    person_in_charge: string;
    contact_number?: string;
    status: RequestStatus;
    user: { id?: number; name: string; email: string } | null;
    attachment_url: string | null;
    attachment_name: string | null;
}

export interface FacilityRequestDetail extends FacilityRequestSummary {
    services: {
        pat: boolean;
        emc_room: boolean;
        tv_room: boolean;
    };
    classification: {
        institutional: boolean;
        curricular: boolean;
        co_curricular: boolean;
        extra_curricular: boolean;
        outside_group: boolean;
    };
    decided_by: { id: number; name: string } | null;
    decided_at: string | null;
}
